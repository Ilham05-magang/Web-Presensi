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
flatpickr("#time-picker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i:S", // Include seconds
    time_24hr: true, // Use 24-hour format
    enableSeconds: true, // Enable seconds
    minuteIncrement: 1, // Allow minute increments
    secondIncrement: 1 // Allow second increments
});

