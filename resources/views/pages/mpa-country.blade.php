@extends('layouts.app')

@section('content')
<div class="text-center mt-12 font-bold text-base md:text-xl lg:text-2xl">
    <h1 class="text-center mb-4">Marine Protected Areas - {{ $country }}</h1>
</div>

<!-- Peta akan muncul di sini -->
<div class="relative h-screen px-10 py-5 z-0">
    <div id="mpaMap" class="h-[calc(100vh-100px)] w-full"></div>
    <div class="text-right text-xs">
        <p>Source of data: Protected Planet</p>
    </div>
</div>

<!-- Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const map = L.map('mpaMap'); 

        // Tambahkan peta dasar
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch("{{ $polygonData }}")
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Polygon Data:', data);
        polygonsLayer = L.geoJSON(data, {
            style: {
                color: '#2c7fb8',
                fillColor: '#41b6c4',
                fillOpacity: 0.6,
                weight: 1
            }
        }).addTo(map);

        const bounds = polygonsLayer.getBounds();
        map.fitBounds(bounds);
    })
    .catch(error => console.error('Error loading polygons:', error));

        });
    </script>

@endsection
