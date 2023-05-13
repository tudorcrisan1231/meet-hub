<div class="main_container_fluid">
    <div class="profile_btn-nav">
    <a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.875 19.3l-6.6-6.6q-.15-.15-.213-.325T4 12q0-.2.063-.375t.212-.325l6.6-6.6q.275-.275.688-.287t.712.287q.3.275.313.688T12.3 6.1L7.4 11h11.175q.425 0 .713.288t.287.712q0 .425-.287.713t-.713.287H7.4l4.9 4.9q.275.275.288.7t-.288.7q-.275.3-.7.3t-.725-.3Z"/></svg>
</a>
    <a href="{{route('signout')}}"class="profile_btn-nav_link" >Logout</a>
    </div>
    <div class="conteiner_profile">
   @if($current_img)
        <img class="profile_img_profile" src="{{asset('storage/'.$current_img)}}" alt="logo">
    @else
        <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="logo">
    @endif
    <div class="profile_group_label">
        <label class="profile_text" for="profile_img">Actualizeaza imaginea de profil</label>
        <input type="file" id="profile_img" wire:model="profile_img" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_name">Actualizeaza numele</label>
        <input type="text" id="profile_name" wire:model="profile_name" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_phone">Actualizeaza telefon</label>
        <input type="text" id="profile_phone" wire:model="profile_phone" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_birthday">Actualizeaza ziua de nastere</label>
        <input type="date" id="profile_birthday" wire:model="profile_birthday" class="input">
    </div>


    <div class="profile_group_label">
        <label class="profile_text" for="profile_gender">Actualizeaza sex</label>
        <select name="" id="profile_gender" wire:model="profile_gender" class="input">
            <option value="1">Barbat</option>
            <option value="2">Femeie</option>
            <option value="3">Altceva</option>
        </select>
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_address">Actualizeaza adresa</label>
        <input type="text" id="profile_address" wire:model="profile_address" class="input">
    </div>

    <div class="profile_group_label">
        <label class="profile_text" for="profile_about">Actualizeaza descrierea ta</label>
        <textarea name="" id="profile_about" cols="30" rows="20" wire:model="profile_about" class="input select"></textarea>
    </div>

    <div class="mod_profile_btn" wire:click="saveProfile" class="button-login">Actualizeaza profil</div>
    </div>
</div>