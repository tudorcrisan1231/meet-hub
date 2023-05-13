@extends('layouts.main')

@section('content')
<div class="main-container" style="position: relative;">
    <div id="map" style="height: 100%;"></div>
    
    <a href="{{route('profile')}}" class="profile_btn">
        @if($user->photo)
            <img src="{{asset('storage/'.$user->photo)}}" alt="logo">
        @else
            <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="logo">
        @endif
    </a>

    <div class="card">
        <div class="card_events">

        </div>
        <div class="card_btns">
            <div class="card_btns_btn button_login_register"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 18q-.425 0-.713-.288T3 17q0-.425.288-.713T4 16h16q.425 0 .713.288T21 17q0 .425-.288.713T20 18H4Zm0-5q-.425 0-.713-.288T3 12q0-.425.288-.713T4 11h16q.425 0 .713.288T21 12q0 .425-.288.713T20 13H4Zm0-5q-.425 0-.713-.288T3 7q0-.425.288-.713T4 6h16q.425 0 .713.288T21 7q0 .425-.288.713T20 8H4Z"/></svg></div>
            <div class="card_btns_btn button_login_register">Events</div>
            <a href="{{route('add_event')}}" class="card_btns_btn button_login_register">Create</a>
        </div>
    </div>
</div>
<style>
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