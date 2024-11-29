document.addEventListener('DOMContentLoaded', function () {
    // Ensure the DOM is fully loaded before running the script
    const logoutButton = document.querySelector('#signOutBtn');
    if (logoutButton) {
        logoutButton.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default link action
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to sign out?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, sign out!',
                cancelButtonText: 'No, stay logged in'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php'; // Adjust the URL to your logout script
                }
            });
        });
    } else {
        console.error("Logout button (signOutBtn) not found!");
    }
});
