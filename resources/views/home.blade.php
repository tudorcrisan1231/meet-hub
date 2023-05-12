@extends('layouts.main')

@section('content')
    <div>{{auth()->user()->name}}</div>
    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <div id="map" style="height: 380px"></div>

    <script>
        function getCurrentCoordinates() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        resolve({ latitude, longitude });
                        },
                        (error) => {
                        reject(error);
                        }
                    );
                } else {
                    reject(new Error('Geolocation is not supported by this browser.'));
                }
            });
        }

        getCurrentCoordinates()
        .then((coordinates) => {
            const latitude = coordinates.latitude;
            const longitude = coordinates.longitude;

            var map = L.map('map').setView([latitude, longitude], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Locatia ta')
                .openPopup();
        }) //in caz ca nu merge locatia o pun eu hardcodata
        .catch((error) => {
            var map = L.map('map').setView([45.7458483, 21.2403663], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([45.7458483, 21.2403663]).addTo(map)
                .bindPopup('Complexul studentilor')
                .openPopup();
        });
    </script>
@endsection