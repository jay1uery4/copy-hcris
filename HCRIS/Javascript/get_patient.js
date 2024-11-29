function updatePatientName() {
    const patientDropdown = document.getElementById('patient_id');
    const patientNameInput = document.getElementById('patient_name');

    if (patientDropdown.selectedIndex > 0) {  // Check if a valid option is selected
        const selectedOption = patientDropdown.options[patientDropdown.selectedIndex];
        patientNameInput.value = selectedOption.getAttribute('data-name'); // Corrected attribute
    } else {
        patientNameInput.value = ''; // Clear field if no valid selection
    }
}
