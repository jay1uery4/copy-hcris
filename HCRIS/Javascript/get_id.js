function updateMedicineName() {
    const medicineDropdown = document.getElementById('medicine_id');
    const medicineNameInput = document.getElementById('medicine_name');

    if (medicineDropdown.selectedIndex > 0) {  // Check if a valid option is selected
        const selectedOption = medicineDropdown.options[medicineDropdown.selectedIndex];
        medicineNameInput.value = selectedOption.getAttribute('data-name'); // Corrected attribute
    } else {
        medicineNameInput.value = ''; // Clear field if no valid selection
    }
}
