<div class="" style="padding-bottom: 5rem;">
    <div class="register-login-title">Creaza un eveniment</div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_img">Imaginea principala</label>
        <input type="file" id="event_img" wire:model="event_img" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_name">Numele eventului</label>
        <input type="text" id="event_name" wire:model="event_name" class="input">
    </div>

    <div>
        <label for="event_description">descrierea ta</label>
        <textarea name="" id="event_description" cols="30" rows="10" wire:model="event_description" class="input-login"></textarea>
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_date">Data cand are loc</label>
        <input type="date" id="event_date" wire:model="event_date" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_time">Durata evenutului (in ore)</label>
        <input type="text" id="event_time" wire:model="event_time" class="input">
    </div>


    <div class="profile_group_label">
        <label class="profile_text" for="event_limit">Limita de persoane</label>
        <input type="number" id="event_limit" wire:model="event_limit" class="input">
    </div>

    <label class="profile_text">Selecteaza locatia</label>
    <div id="map" style="height: 50rem; width:100%"></div>

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

            //add onclick on map
            map.on('click', function(e) {
                var coord = e.latlng;
                var lat = coord.lat;
                var lng = coord.lng;
                console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);
            });

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
</div>
