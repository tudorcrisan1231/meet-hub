<div class="main_container_fluid" style="padding-bottom: 5rem;">
<div class="profile_btn-nav">
<a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.875 19.3l-6.6-6.6q-.15-.15-.213-.325T4 12q0-.2.063-.375t.212-.325l6.6-6.6q.275-.275.688-.287t.712.287q.3.275.313.688T12.3 6.1L7.4 11h11.175q.425 0 .713.288t.287.712q0 .425-.287.713t-.713.287H7.4l4.9 4.9q.275.275.288.7t-.288.7q-.275.3-.7.3t-.725-.3Z"/></svg>
</a>
</div>
    <div class="create_title">Create event</div>



    <div class="profile_group_label">
        <label class="profile_text" for="event_name">Event name</label>
        <input type="text" id="event_name" wire:model="event_name" class="input">
    </div>

    
    <label class="profile_text" style="margin-top:4rem;">Selecteaza locatia</label>
    <div id="map" style="height: 50rem; width:100%"></div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_about">Event Description</label>
        <textarea name="" id="profile_about" cols="30" rows="10" wire:model="event_description" class="input select"></textarea>
    </div>
    <div class="profile_group_label">
        <label class="profile_text" for="event_theme">Theme</label>
        <select name="" id="event_theme" wire:model="event_theme" class="input">
            @foreach ($themes as $theme)
                <option value="{{$theme->name}}">{{$theme->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_date">Date</label>
        <input type="date" id="event_date" wire:model="event_date" class="input date_e">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_time">Duration of the event (hours)</label>
        <input type="text" id="event_time" wire:model="event_time" class="input">
    </div>


    <div class="profile_group_label">
        <label class="profile_text" for="event_limit">The number of people</label>
        <input type="number" id="event_limit" wire:model="event_limit" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="event_img">Main image</label>
        <input type="file" id="event_img" wire:model="event_img" class="input">
    </div>



    <div class="button_login_register" wire:click="addEvent" style="width: 95%;">
        Adauga event
    </div>

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

            var map = L.map('map').setView([latitude, longitude], 14);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup(L.popup({
                autoClose:false,
                closeOnClick: false,
                className: 'cur-popup',
            })
            )
            .setPopupContent('<div class="cur-popup"><h3>Locatia aleasa</h3></div>')
            .openPopup();
            
            //save coordinates in cookie
            document.cookie = "lat=" + latitude;
            document.cookie = "lng=" + longitude;

            //add onclick on map
            map.on('click', function(e) {
                var coord = e.latlng;
                var lat = coord.lat;
                var lng = coord.lng;
                console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);

                marker.remove();

                marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(L.popup({
                    autoClose:false,
                    closeOnClick: false,
                    className: 'cur-popup',
                })
                )
                .setPopupContent('<div class="cur-popup"><h3>Locatia aleasa</h3></div>')
                .openPopup();
                map.setView([lat,lng]);

                //save coordinates in cookie
                document.cookie = "lat=" + lat;
                document.cookie = "lng=" + lng;
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
