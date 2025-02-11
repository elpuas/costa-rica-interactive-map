document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map
    const map = L.map('costa-rica-map').setView([9.7489, -83.7534], 7);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Example marker
    const marker = L.marker([9.7489, -83.7534])
        .addTo(map)
        .bindPopup('Welcome to Costa Rica!')
        .openPopup();
}); 