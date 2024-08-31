import './bootstrap';
import 'flowbite';
import 'remixicon/fonts/remixicon.css';

document.addEventListener('DOMContentLoaded', () => {
    const dropdownButton = document.getElementById('dropdown');
    const dropdownMenu = document.getElementById('dropdown-user');
    const dropdownIcon = document.getElementById('dropdown-icon');

    dropdownButton.addEventListener('click', () => {
        // Toggle visibility
        dropdownMenu.classList.toggle('hidden');

        // Toggle icon
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownIcon.classList.remove('ri-arrow-drop-up-line');
            dropdownIcon.classList.add('ri-arrow-drop-down-line');
        } else {
            dropdownIcon.classList.remove('ri-arrow-drop-down-line');
            dropdownIcon.classList.add('ri-arrow-drop-up-line');
        }
    });

});

function togglePasswordVisibility(id, iconId) {
    const passwordField = document.getElementById(id);
    const eyeIcon = document.getElementById(iconId);
    const isPassword = passwordField.type === 'password';
    passwordField.type = isPassword ? 'text' : 'password';
    eyeIcon.classList.toggle('ri-eye-fill', isPassword);
    eyeIcon.classList.toggle('ri-eye-off-fill', !isPassword);
}

document.getElementById('togglePassword').addEventListener('click', function () {
    togglePasswordVisibility('password', 'eyeIcon');
});

document.getElementById('toggleKonfirmasiPassword').addEventListener('click', function () {
    togglePasswordVisibility('password_confirmation', 'eyeIconKonfirmasi');
});
flatpickr("#time-picker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i:S", // Include seconds
    time_24hr: true, // Use 24-hour format
    enableSeconds: true, // Enable seconds
    minuteIncrement: 1, // Allow minute increments
    secondIncrement: 1 // Allow second increments
});

const buttonEdit = document.getElementById('buttonEdit');
const editstatusElements = document.querySelectorAll('.editstatus');
const buttonfirst = document.getElementById('buttonfirst');
const submitForm = document.getElementById('submitForm');
const BatalEdit = document.getElementById('BatalEdit');

buttonEdit.addEventListener('click', function() {
    buttonfirst.disabled = !buttonfirst.disabled;
    submitForm.classList.remove('hidden');
    BatalEdit.classList.remove('hidden');
    buttonfirst.classList.remove('hover:bg-yellow-300', 'hover:text-gray-800');
    buttonfirst.classList.add('bg-yellow-100');

    editstatusElements.forEach(function(element) {
        if (element.tagName === 'INPUT' || element.tagName === 'SELECT' || element.tagName === 'BUTTON') {
            element.disabled = !element.disabled;
        }
    });
});

BatalEdit.addEventListener('click', function() {
    buttonfirst.disabled = !buttonfirst.disabled;
    submitForm.classList.add('hidden');
    BatalEdit.classList.add('hidden');

    buttonfirst.classList.add('hover:bg-yellow-300', 'hover:text-gray-800');
    buttonfirst.classList.remove('bg-yellow-100');
    editstatusElements.forEach(function(element) {
        if (element.tagName === 'INPUT' || element.tagName === 'SELECT'|| element.tagName === 'BUTTON') {
            element.disabled = !element.disabled;
        }
    });
});



