{{-- <div class="inline-flex rounded-md mt-10 px-8 md:px-0 xl:px-16" role="group">
    <button
        type="button"
        data-api-url="{{ url('/api/aquaculture-production') }}"
        data-method="linear"
        class="rounded-s-lg border border-black bg-transparent px-6 md:px-12 lg:px-20 xl:px-20 py-2 md:py-5 xl:py-3 text-xs md:text-sm font-medium">
        Aquaculture Production
    </button>
    <button
        type="button"
        data-api-url="{{ url('/api/capture-fisheries-production') }}"
        data-method="stddev"
        class="border-b border-t border-black bg-transparent px-8 md:px-12 lg:px-20 xl:px-20 py-2 md:py-5 xl:py-3 text-xs md:text-sm font-medium">
        Capture Fisheries Production
    </button>
    <button
        type="button"
        data-api-url="{{ url('/api/marine-protected-areas') }}"
        data-method="linear"
        class="border border-black bg-transparent px-8 md:px-12 lg:px-20 xl:px-20 py-2 md:py-5 xl:py-3 text-xs md:text-sm font-medium hover:bg-gray-900 hover:text-white focus:z-10 focus:bg-white focus:text-[#079D75]
        {{ Route::currentRouteName() == 'pages.maps-marineProtectedAreas' ? 'text-[#079D75]' : 'text-[#0021A3]' }}">
        Marine Protected Areas
    </button>
    <button
        type="button"
        data-api-url="{{ url('/api/total-fisheries-production') }}"
        data-method="stddev"
        class="rounded-e-lg border-r border-b border-t border-black bg-transparent px-8 md:px-14 lg:px-24 xl:px-20 py-4 md:py-3 text-xs md:text-sm font-medium hover:bg-gray-900 hover:text-white focus:z-10 focus:bg-white focus:text-[#079D75]
        {{ Route::currentRouteName() == 'pages.maps-totalFisheriesProduction' ? 'text-[#079D75]' : 'text-[#0021A3]' }}">
        Total Fisheries Production
    </button>
</div>

<script>
    // Inisialisasi peta di luar event listener
    var map = L.map('map').setView([0, 118], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Event listener untuk setiap tombol
    document.querySelectorAll('button[data-api-url]').forEach(button => {
        button.addEventListener('click', function () {
            const apiUrl = this.getAttribute('data-api-url');

            // Ubah style langsung pada tombol
            document.querySelectorAll('button[data-api-url]').forEach(btn => {
                btn.style.backgroundColor = "transparent"; // Reset warna latar
                btn.style.color = "black"; // Reset warna teks
            });
            this.style.backgroundColor = "#10b981"; // Hijau untuk tombol aktif
            this.style.color = "white"; // Teks putih untuk tombol aktif

            // Fetch data dari API
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Hapus layer lama jika ada
                    if (window.geoJsonLayer) {
                        map.removeLayer(window.geoJsonLayer);
                    }

                    // Hitung statistik deskriptif
                    const values = data.features.map(f => f.properties.value);
                    const stats = calculateStatistics(values);

                    // Tampilkan statistik deskriptif
                    const statsContainer = document.getElementById('statistics');
                    statsContainer.innerHTML = `
                        <p><strong>Statistics:</strong></p>
                        <p>Average: ${stats.avg}</p>
                        <p>Median: ${stats.median}</p>
                        <p>Minimum: ${stats.min}</p>
                        <p>Maximum: ${stats.max}</p>
                    `;

                    // Tambahkan data baru ke peta
                    window.geoJsonLayer = L.geoJSON(data, {
                        style: {
                            color: '#3388ff',
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.7
                        },
                        onEachFeature: function (feature, layer) {
                            layer.bindPopup(
                                `<strong>${feature.properties.name}</strong><br>` +
                                `Value: ${feature.properties.value}`
                            );
                        }
                    }).addTo(map);
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    });

    // Fungsi statistik deskriptif
    function calculateStatistics(values) {
        const sum = values.reduce((a, b) => a + b, 0);
        const avg = (sum / values.length).toFixed(2);
        const min = Math.min(...values);
        const max = Math.max(...values);
        const median = calculateMedian(values);
        return { avg, min, max, median };
    }

    function calculateMedian(values) {
        values.sort((a, b) => a - b);
        const mid = Math.floor(values.length / 2);
        return values.length % 2 !== 0
            ? values[mid]
            : ((values[mid - 1] + values[mid]) / 2).toFixed(2);
    }
</script> --}}
