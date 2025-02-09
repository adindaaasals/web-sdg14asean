console.log("mapScript.js Loaded!");
document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi peta
    const map = L.map('map').setView([0, 118], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let currentIndicator = null; // Menyimpan key focus area yang sedang aktif

    // Menambahkan event listener untuk tombol key focus area
    document.querySelectorAll('button[data-api-url]').forEach(button => {
        console.log("Button Listener Added!");
        button.addEventListener('click', function () {
            const apiUrlBase = this.getAttribute('data-api-url');
            const method = this.getAttribute('data-method');
            const year = document.getElementById('yearSelect').value;

            currentIndicator = { apiUrlBase, method }; // Menyimpan key focus area aktif
            updateIndicatorTitle(this); // Perbarui judul key focus area
            updateLegend(method);  // Update legend sesuai method yang digunakan
            updateColorDescription(method);
            
            fetchDataAndUpdateMap(apiUrlBase, year, method); // Update data dan peta
        });
    });

    // Listener untuk perubahan dropdown tahun
    document.getElementById('yearSelect').addEventListener('change', function () {
        if (currentIndicator) {
            const { apiUrlBase, method } = currentIndicator;
            fetchDataAndUpdateMap(apiUrlBase, this.value, method);
        }
    });

     // Load data dari API dan udpate peta
    function fetchDataAndUpdateMap(apiUrlBase, year, method) {
        console.log("fetchDataAndUpdateMap Called!");

        // Tampilkan loading state sebelum mengambil data
        const statisticsElement = document.getElementById("statistics");
        statisticsElement.textContent = "Loading maps..."; // Menampilkan teks loading
        statisticsElement.style.display = "block"; // Pastikan loading terlihat

        const apiUrl = `${apiUrlBase}?year=${year}`;
        fetch(apiUrl, {
            headers: {
                'Accept': 'application/json' // header Accept
            }
        })
        
            .then(response => response.json())
            .then(data => {
                if (window.geoJsonLayer) {
                    map.removeLayer(window.geoJsonLayer); // Hapus layer lama
                }
                
                const values = data.features.map(f => f.properties.value).filter(v => v !== null);
                console.log("Values Extracted:", values); // Debugging nilai yang diproses

                const stats = calculateStatistics(values);
                console.table(stats); // Debugging statistik (min, max, stdDev, etc.)

                const getColorFunction = method === "linear" ? getColorLinear : getColorStdDev;

                // Tambahkan GeoJSON baru ke peta
                window.geoJsonLayer = L.geoJSON(data, {
                    style: feature => {
                        const value = feature.properties.value;
                        return {
                            color: '#3388ff',
                            weight: 1,
                            opacity: 1,
                            fillColor: value !== null ? getColorFunction(value, stats) : "#cccccc",
                            fillOpacity: 0.7
                        };
                    },
                    onEachFeature: (feature, layer) => {
                        const countryName = feature.properties.name; // Ambil nama negara
                        let value = feature.properties.value; // Ambil nilai key focus area

                        // Format angka dengan pemisah ribuan
                        let formattedValue = value !== null ? value.toLocaleString() : 'Data Unavailable';

                        // Jika key focus area adalah Marine Protected Areas, tambahkan simbol persen
                        const indicatorTitle = document.getElementById('indicatorTitle').textContent.trim();
                        if (indicatorTitle.includes('Marine Protected Areas') && value !== null) {
                            // Konversi nilai menjadi persen dan batasi hanya 1 angka di belakang koma
                            formattedValue = (value * 100).toFixed(1) + '%';  // Mengalikan dengan 100 dan format dengan 1 desimal
                        }

                        const nameFontSize = '16px'; 
                        const valueFontSize = '14px'; 

                        layer.bindPopup(
                           `<div style="text-align: center;">` +
                                `<strong style="font-size: ${nameFontSize};">${countryName}</strong><br>` +
                                `<strong style="font-size: ${valueFontSize};">${formattedValue}</strong>` +
                            `</div>`
                        );
                    }
                }).addTo(map);

                // Auto-zoom ke area yang mencakup seluruh polygon
                const bounds = geoJsonLayer.getBounds();
                map.fitBounds(bounds);

                // Menghilangkan loading setelah data berhasil dimuat
                statisticsElement.textContent = "Map loaded successfully!";
                setTimeout(() => {
                    statisticsElement.style.display = "none"; // Sembunyikan setelah beberapa detik
                }, 2000);
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                statisticsElement.textContent = "Failed to load map data!";
    });
    }

    // Perbarui judul key focus area di UI
    function updateIndicatorTitle(button) {
        const indicatorTitle = document.getElementById('indicatorTitle');
        indicatorTitle.textContent = button.textContent.trim();
    }

    // Menghitung statistik deskriptif
    function calculateStatistics(values) {
        const sum = values.reduce((a, b) => a + b, 0);
        const avg = (sum / values.length).toFixed(2);
        const min = Math.min(...values);
        const max = Math.max(...values);
        const median = calculateMedian(values);
        const stdDev = Math.sqrt(
            values.reduce((a, b) => a + Math.pow(b - avg, 2), 0) / (values.length - 1)
        ).toFixed(2);
        return { avg, min, max, median, stdDev };
    }

    // Pengelompokan warna berdasarkan interval linear
    function getColorLinear(value, stats) {
        value = parseFloat(value);  // Pastikan value adalah float/number
        const { min, max } = stats;
        const range = max - min;
        const intervals = range / 5;

        // Debugging
        console.table({
            "Minimum": min,
            "Maximum": max,
            // "Range": range,
            "Interval": intervals
        });
    
        if (value <= min + intervals) return "#ffffcc";
        if (value <= min + 2 * intervals) return "#a1dab4";
        if (value <= min + 3 * intervals) return "#41b6c4";
        if (value <= min + 4 * intervals) return "#2c7fb8";
        return "#253494";
    }

    // Pengelompokan warna berdasarkan standar deviasi
    function getColorStdDev(value, stats) {
        // Memastikan avg dan stdDev dalam bentuk angka
        const avg = parseFloat(stats.avg);
        const stdDev = parseFloat(stats.stdDev);
    
        // Hitung threshold untuk setiap kategori
        const thresholdVeryLow = avg - 2 * stdDev;
        const thresholdLow = avg - stdDev;
        const thresholdMedium = avg;
        const thresholdHigh = avg + stdDev;

        console.table({
            "average": avg,
            "deviasi": stdDev,
            "sangat rendah": thresholdVeryLow,
            "rendah": thresholdLow,
            "sedang": thresholdMedium,
            "tinggi": thresholdHigh
        });
    
        if (value <= thresholdVeryLow) {
            console.log(`Sangat Rendah: Value=${value}, Threshold=${thresholdVeryLow}`);
            return "#ffffcc"; // Sangat Rendah
        }
        if (value > thresholdVeryLow && value <= thresholdLow) {
            console.log(`Rendah: Value=${value}, Threshold=${thresholdVeryLow} < Value <= ${thresholdLow}`);
            return "#a1dab4"; // Rendah
        }
        if (value > thresholdLow && value <= thresholdMedium) {
            console.log(`Sedang: Value=${value}, Threshold=${thresholdLow} < Value <= ${thresholdMedium}`);
            return "#41b6c4"; // Sedang
        }
        if (value > thresholdMedium && value <= thresholdHigh) {
            console.log(`Tinggi: Value=${value}, Threshold=${thresholdMedium} < Value <= ${thresholdHigh}`);
            return "#2c7fb8"; // Tinggi
        }
        console.log(`Sangat Tinggi: Value=${value}, Threshold=${thresholdHigh}`);
        return "#253494"; // Sangat Tinggi
    }    
    

    function updateLegend(method) {
        const legend = document.getElementById("legend");
        if (method === "linear") {
            legend.innerHTML = `
                <h3 class="text-[8px] md:text-xs lg:text-sm font-bold mb-2">Linear Interval</h3>
                <ul class="list-none">
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #ffffcc;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Very Low</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #a1dab4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Low</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #41b6c4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Medium</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #2c7fb8;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">High</span>
                    </li>
                    <li class="flex items-center">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #253494;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Very High</span>
                    </li>
                </ul>
            `;
        } else if (method === "stddev") {
            legend.innerHTML = `
                <h3 class="text-[8px] md:text-xs lg:text-sm font-bold mb-2">Standard Deviation</h3>
                <ul class="list-none">
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #ffffcc;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Very Below Average</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #a1dab4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Below Average</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #41b6c4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Average</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #2c7fb8;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Above Average</span>
                    </li>
                    <li class="flex items-center">
                        <span class="inline-block w-4 h-4 mr-2" style="background-color: #253494;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm">Very Above Average</span>
                    </li>
                </ul>
            `;
        }
    }
    
    function updateColorDescription(method) {
        const colordesc = document.getElementById("colordesc");
        if (method === "linear") {
            colordesc.innerHTML = `
                <h3 class="text-[10px] md:text-sm lg:text-base font-bold mb-2 px-10">Color Description</h3>
                <ul class="list-none px-10">
                    <li class="flex items-center mb-1">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #ffffcc;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is very low, indicating a condition that requires special attention for management.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #a1dab4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is low, still below average but not too significant.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #41b6c4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is moderate, indicating an average level of achievement or a fairly stable level of sustainability.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #2c7fb8;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is high, indicating sustainability or achievement in certain indicators.</span>
                    </li>
                    <li class="flex items-center pb-10">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #253494;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is very high, reflecting extraordinary success in related indicators.</span>
                    </li>
                </ul>
            `;
        } else if (method === "stddev") {
            colordesc.innerHTML = `
                <h3 class="text-[10px] md:text-sm lg:text-base font-bold mb-2 px-10">Color Description</h3>
                <ul class="list-none px-10 mb-10">
                    <li class="flex items-center mb-1">
                        <span class="inline-block mr-2 w-4 h-4 lg:w-8 lg:h-8" style="background-color: #ffffcc;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is very far below average, indicating significant problems.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 lg:h-8 lg:w-8 mr-2" style="background-color: #1adab4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is below average, requiring improvements in management or sustainability.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 lg:h-8 lg:w-8 mr-2" style="background-color: #41b6c4;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is at the average level, showing stable performance but still has room for improvement.</span>
                    </li>
                    <li class="flex items-center mb-1">
                        <span class="inline-block w-4 h-4 lg:h-8 lg:w-8 mr-2" style="background-color: #2c7fb8;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is above average, reflecting good achievements in managing certain indicators.</span>
                    </li>
                    <li class="flex items-center">
                        <span class="inline-block w-4 h-4 lg:h-8 lg:w-8 mr-2" style="background-color: #253494;"></span>
                        <span class="text-[8px] md:text-xs lg:text-sm text-justify">The data value is far above average, reflecting extraordinary or optimal success.</span>
                    </li>
                </ul>
            `;
        }
    }

    // Menghitung median dari array nilai
    function calculateMedian(values) {
        values.sort((a, b) => a - b);
        const mid = Math.floor(values.length / 2);
        return values.length % 2 !== 0
            ? values[mid]
            : ((values[mid - 1] + values[mid]) / 2).toFixed(2);
    }

    // document.querySelectorAll('button[data-api-url]').forEach(button => {
    //     button.addEventListener('click', function () {
    //         const method = this.getAttribute('data-method');
    //         updateLegend(method); // Perbarui keterangan warna
    //         updateColorDescription(method); // Perbarui deskripsi warna
    //     });
    // });


    // Render peta Marine Protected Areas menggunakan data JSON
    function renderMPAMap(pointsData, polygonsData) {
        // Memastikan elemen HTML dengan ID 'mpaMap' ada
        if (!document.getElementById('mpaMap')) return;

        // Inisialisasi peta
        const map = L.map('mpaMap').setView([0, 118], 4);

        // Menambahkan layer peta dasar
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Menambahkan polygons GeoJSON
        const polygonsLayer = L.geoJSON(polygonsData, {
            style: {
                color: '#2c7fb8',
                fillColor: '#41b6c4',
                fillOpacity: 0.6,
                weight: 1
            },
            onEachFeature: (feature, layer) => {
                const name = feature.properties?.NAME || "Protected Area";
                layer.bindPopup(`<strong>${name}</strong>`);
            }
        }).addTo(map);

        // Menambahkan points GeoJSON
        const pointsLayer = L.geoJSON(pointsData, {
            pointToLayer: (feature, latlng) => {
                return L.circleMarker(latlng, {
                    radius: 6,
                    fillColor: '#ff7800',
                    color: '#000',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });
            },
            onEachFeature: (feature, layer) => {
                const name = feature.properties?.NAME || "Point of Interest";
                layer.bindPopup(`<strong>${name}</strong>`);
            }
        }).addTo(map);

        // Kontrol layer (opsional)
        L.control.layers(null, {
            "Polygons": polygonsLayer,
            "Points": pointsLayer
        }).addTo(map);
    }
});
