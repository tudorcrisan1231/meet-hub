<div class="main_container_fluid">
    <a href="{{route('signout')}}">logout</a>
    <a href="{{route('home')}}" style="font-size: 3rem;">BACK</a>
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

    <div>
        <label for="profile_address">Actualizeaza adresa</label>
        <input type="text" id="profile_address" wire:model="profile_address" class="input-login">
    </div>

    <div>
        <label for="profile_about">Actualizeaza descrierea ta</label>
        <textarea name="" id="profile_about" cols="30" rows="10" wire:model="profile_about" class="input-login"></textarea>
    </div>

    <div wire:click="saveProfile" class="button-login">Actualizeaza profil</div>
</div>