// import L from 'leaflet';

// const latitude = 5; // Koordinat pusat ASEAN
// const longitude = 115; // Koordinat pusat ASEAN
// const zoomLevel = 5; // Level zoom untuk ASEAN

// document.addEventListener('DOMContentLoaded', function () {
//     const map = L.map('map').setView([latitude, longitude], zoomLevel);
    
//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '© OpenStreetMap contributors'
//     }).addTo(map);    

//     // Load GeoJSON dan Data API
//     fetch('/geojson/asean_countries.geojson')
//         .then(response => response.json())
//         .then(geoData => {
//             console.log("GeoJSON Data:", geoData);
//             // Load data dari API
//             fetch('/api/aquaculture-production')
//                 .then(response => response.json())
//                 .then(apiData => {
//                     console.log("API Data:", apiData);  // Debug
//                     // Buat choropleth layer
//                     L.geoJson(geoData, {
//                         style: feature => {
//                             // Cari data negara berdasarkan kode negara
//                             const countryData = apiData.find(country => country.country_code === feature.properties.ISO_A3);
//                             const value = countryData ? countryData.year_2022 : 0;
//                             return {
//                                 fillColor: getColor(value),
//                                 weight: 2,
//                                 opacity: 1,
//                                 color: 'white',
//                                 fillOpacity: 0.7
//                             };
//                         },
//                         onEachFeature: (feature, layer) => {
//                             // Cari data negara berdasarkan kode negara
//                             const countryData = apiData.find(country => country.country_code === feature.properties.ISO_A3);
//                             if (countryData) {
//                                 // Tambahkan informasi ketika di-hover
//                                 layer.bindTooltip(`<b>${countryData.country_name}</b><br>Produksi: ${countryData.year_2022}`);
//                             }

//                             // Tambahkan event klik untuk navigasi ke halaman detail negara
//                             layer.on('click', () => {
//                                 window.location.href = `/country/${countryData.country_code}`;
//                             });
//                         }
//                     }).addTo(map);
//                 });
//         });
// });

// // Fungsi untuk mengatur warna berdasarkan nilai
// function getColor(value) {
//     return value > 1000000 ? '#800026' :
//            value > 500000  ? '#BD0026' :
//            value > 200000  ? '#E31A1C' :
//            value > 100000  ? '#FC4E2A' :
//            value > 50000   ? '#FD8D3C' :
//            value > 20000   ? '#FEB24C' :
//            value > 10000   ? '#FED976' :
//                              '#FFEDA0';
// }

// console.log("MapComponent Loaded");
