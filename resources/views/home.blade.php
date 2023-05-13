@extends('layouts.main')

@section('content')
<div class="main-container" style="position: relative;">
    <div id="map" style="height: 105%;"></div>
    
    <a href="{{route('profile')}}" class="profile_btn">
        @if($user->photo)
            <img src="{{asset('storage/'.$user->photo)}}" alt="logo">
        @else
            <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="logo">
        @endif
    </a>

    <div class="card">
        <div class="card_events" style="overflow: scroll;">
            @foreach ($events as $event)
                @livewire('event-card', ['event' => $event])
            @endforeach
        </div>
        <div class="card_btns">
            <div class="card_btns_btn button_login_register card_btns_open"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 18q-.425 0-.713-.288T3 17q0-.425.288-.713T4 16h16q.425 0 .713.288T21 17q0 .425-.288.713T20 18H4Zm0-5q-.425 0-.713-.288T3 12q0-.425.288-.713T4 11h16q.425 0 .713.288T21 12q0 .425-.288.713T20 13H4Zm0-5q-.425 0-.713-.288T3 7q0-.425.288-.713T4 6h16q.425 0 .713.288T21 7q0 .425-.288.713T20 8H4Z"/></svg></div>
            <div class="card_btns_btn button_login_register">Events</div>
            <a href="{{route('add_event')}}" class="card_btns_btn button_login_register">Create</a>
        </div>
    </div>

    <div class="sidebar">
        <div>salut</div>
        <div>salut</div>
        <div>salut</div>

        <div class="sidebar_close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275L12 13.4Z"/></svg>
        </div>
    </div>
</div>
<style>
    .sidebar{
        position: fixed;
        background-color: white;
        top: 0;
        left: -100%;
        width: 40%;
        height: 100%;
        z-index: 999;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-right: 1px solid #ccc;
        transition: all .2s;
    }
    .sidebar_active{
        left: 0;
    }
    .sidebar_close{
        position: absolute;
        right: 1rem;
        top: 1rem;
    }
    .sidebar_close svg{
        width: 30px;
        height: 30px;
        cursor: pointer;
    }
    .cur-popup{
        background-color: #222327;
        border-radius: 5px;
        color: white;
    }
    .leaflet-popup-tip{
        background-color: #222327;
        border: none;
       
    }
    .leaflet-popup-content-wrapper{
        background-color: transparent;
        border: none;
        border-radius: 0;
    }
    .leaflet-popup-content{
        color: white;
        font-size: 1.4rem;
    }
    .card{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 45%;
        background-color: #fff;
        border-radius: 1rem 1rem 0 0;
        z-index: 999;

        display: grid;
        grid-template-rows: 1fr max-content;
        gap: .5rem;
    }
    .card_btns{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: .5rem;
    }
    .card_btns_btn{
        width: 100%;
        margin: 0;
    }
    .profile_btn{
        position: absolute;
        top: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        z-index: 999;
    }
    .profile_btn img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        cursor: pointer;
    }
</style>

<script>
    const card_btns_open = document.querySelector('.card_btns_open');
    const sidebar = document.querySelector('.sidebar');
    const sidebar_close = document.querySelector('.sidebar_close');
    card_btns_open.addEventListener('click', () => {
        sidebar.classList.add('sidebar_active');
    });
    sidebar_close.addEventListener('click', () => {
        sidebar.classList.remove('sidebar_active');
    });

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

        
       //render events on map
        @foreach ($events as $event)
            lat = {{json_decode($event->location)[0]}};
            lng = {{json_decode($event->location)[1]}};
            L.marker([lat, lng]).addTo(map)
            .bindPopup(L.popup({
                autoClose:false,
                closeOnClick: false,
                className: 'cur-popup',
            })
            )
            .setPopupContent('<div class="cur-popup"><h3>{{$event->name}}</h3></div>')
            .openPopup();

            map.setView([lat,lng]);
        @endforeach
      
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