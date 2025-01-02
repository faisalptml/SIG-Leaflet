<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Gempa Indonesia</title>

    <!-- CSS Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
   
    <style>
        #map { height: 570px; }
        #title, #sub { text-align: center; }
    </style>

    <!-- JS Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

</head>
<body>
    <h1 id="title">DATA GEMPA BUMI DI INDONESIA 2024</h1>
    <H3 id="sub">Sumber data: BMKG</H3>
    <div id="map"></div>
        <script>
            var map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{ maxZoom: 5,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let dataG = {!! file_get_contents("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json")  !!};
            console.log(dataG);
            let number = 0;
            let dataGempa = dataG.Infogempa.gempa;
            dataGempa.forEach(gempa => {
                let kordinat = gempa.Coordinates.split(",");
                let _lat = kordinat[0];
                let _lon = kordinat[1];
                let marker = L.marker([_lat, _lon]).addTo(map);
                marker.bindPopup(number + ". Waktu : " + gempa.Tanggal + ":" + gempa.Jam + 
                "<br>" + "Wilayah : " + gempa.Wilayah + "<br>" + 
                "Kedalaman : " + gempa.Kedalaman + ", " + gempa.Magnitude + " SR" + "<br>" +
                "Potensi : " + gempa.Potensi);
                number++;
            });

        </script>
</body>
</html>