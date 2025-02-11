// Import Leaflet
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    const map = L.map('costa-rica-map').setView([9.7489, -83.7534], 7);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Store markers in a layer group
    const markersLayer = L.layerGroup().addTo(map);

    // Function to create popup content
    function createPopupContent(tour) {
        return `
            <div class="tour-popup">
                <h3>${tour.title}</h3>
                <p>${tour.excerpt}</p>
                <p><strong>Zones:</strong> ${tour.zones.join(', ')}</p>
                <a href="${tour.permalink}" class="tour-link">View Tour Details</a>
            </div>
        `;
    }

    // Function to load and display tours
    function loadTours(zone = null) {
        // Clear existing markers
        markersLayer.clearLayers();

        // Prepare the AJAX URL
        let ajaxUrl =
            costaRicaMapData.ajaxurl + '?action=get_tours&nonce=' + costaRicaMapData.nonce;
        if (zone) {
            ajaxUrl += '&zone=' + encodeURIComponent(zone);
        }

        // Fetch tours data
        fetch(ajaxUrl)
            .then(response => response.json())
            .then(response => {
                if (response.success && response.data) {
                    response.data.forEach(tour => {
                        const marker = L.marker([tour.latitude, tour.longitude]).bindPopup(
                            createPopupContent(tour)
                        );
                        markersLayer.addLayer(marker);
                    });
                }
            })
            .catch(error => console.error('Error loading tours:', error));
    }

    // Load all tours when the map initializes
    loadTours();
});
