<?php

require 'db_conn.php';

if(!$conn){
   die('Connection failed: ' . mysqli_connect_error()); // Show the exact error for debugging
}

// Get data from the form using isset to avoid undefined index errors
$consultation_id = isset($_POST['consultation_id']) ? $_POST['consultation_id'] : null;
$health_id = isset($_POST['healthcare_id']) ? $_POST['healthcare_id'] : null;
$patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : null;
$patient_name = isset($_POST['patient_name']) ? $_POST['patient_name'] : null;
$medicine_id = isset($_POST['medicine_id']) ? $_POST['medicine_id'] : null;
$medicine_name = isset($_POST['medicine_name']) ? $_POST['medicine_name'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$time_ = isset($_POST['time']) ? $_POST['time'] : null;
$date_ = isset($_POST['date']) ? $_POST['date'] : null;

// Check if all fields are set
if (!$consultation_id || !$health_id || !$patient_id || !$patient_name || !$medicine_id || !$medicine_name || !$quantity || !$time_ || !$date_) {
    echo "Error: All fields are required.";
    exit();
}

// Check if the medicine exists in the medicine table
$selectMedicineQuery = "SELECT medicine_quantity FROM admin_medicine_inventory WHERE medicine_name = ?";
$stmt = $conn->prepare($selectMedicineQuery);
$stmt->bind_param("s", $medicine_name);
$stmt->execute();
$resultMedicine = $stmt->get_result();

if ($resultMedicine && $resultMedicine->num_rows > 0) {
   // Medicine exists, proceed with subtraction and insertion

   // Get the current quantity from the medicine table
   $rowMedicine = $resultMedicine->fetch_assoc();
   $currentQuantity = $rowMedicine['medicine_quantity'];

   // Check if there are enough medicines in stock
   if ($currentQuantity >= $quantity) {
      // Perform subtraction in the medicine table
      $updateMedicineQuery = "UPDATE admin_medicine_inventory SET medicine_quantity = medicine_quantity - ? WHERE medicine_name = ?";
      $stmtUpdate = $conn->prepare($updateMedicineQuery);
      $stmtUpdate->bind_param("is", $quantity, $medicine_name);
      $stmtUpdate->execute();

      if ($stmtUpdate->affected_rows > 0) {
         // Insert data into the consultation table
         $insertConsultationQuery = "INSERT INTO medical_record (consultation_id, healthcare_id, patient_id, patient_name, medicine_id, medicine_name, quantity, time_, date_) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         $stmtInsert = $conn->prepare($insertConsultationQuery);
         $stmtInsert->bind_param("iissssiss", $consultation_id, $health_id, $patient_id, $patient_name, $medicine_id, $medicine_name, $quantity, $time_, $date_);
         
         if ($stmtInsert->execute()) {
            echo '
               <script type="text/javascript">
                  alert("Record saved successfully.");
                  window.location = "adminconsultation.php"; 
               </script>
            ';
         } else {
            echo "Error: Could not save the record. " . $conn->error;
         }
      } else {
         echo "Error: Could not update medicine inventory. " . $conn->error;
      }
   } else {
      // Not enough medicines in stock
      echo '
      <script type="text/javascript">
         alert("Error: Not enough medicines in stock.");
         window.location = "adminmedicine.php"; 
      </script>
      ';
      exit();
   }
} else {
   // Medicine does not exist in the medicine table
   echo "Error: Medicine not found in the inventory.";
}

$conn->close();
?>
