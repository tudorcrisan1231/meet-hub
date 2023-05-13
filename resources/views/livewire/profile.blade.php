<div class="main_container_fluid">
    <div class="profile_btn-nav">
    <a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" >BACK</a>
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