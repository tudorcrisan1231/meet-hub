<div class="main_container_fluid">
    <div class="profile_btn-nav">
    <a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.875 19.3l-6.6-6.6q-.15-.15-.213-.325T4 12q0-.2.063-.375t.212-.325l6.6-6.6q.275-.275.688-.287t.712.287q.3.275.313.688T12.3 6.1L7.4 11h11.175q.425 0 .713.288t.287.712q0 .425-.287.713t-.713.287H7.4l4.9 4.9q.275.275.288.7t-.288.7q-.275.3-.7.3t-.725-.3Z"/></svg>
    </a>
    @if($view == 0)
        <a href="{{route('signout')}}"class="profile_btn-nav_link" >Logout</a>
    @endif
    </div>
    <div class="conteiner_profile">
   @if($current_img)
        <img class="profile_img_profile" src="{{asset('storage/'.$current_img)}}" alt="logo">
    @else
        <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="logo">
    @endif
    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_img">Actualizeaza imaginea de profil</label>
            <input type="file" id="profile_img" wire:model="profile_img" class="input">
        @endif
    </div>

    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_name">Actualizeaza numele</label>
            <input type="text" id="profile_name" wire:model="profile_name" class="input">
        @else
            <label class="profile_text" for="profile_name">Nume</label>
            <input type="text" id="profile_name" wire:model="profile_name" class="input" disabled>
        @endif
    </div>

    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_phone">Actualizeaza telefon</label>
            <input type="text" id="profile_phone" wire:model="profile_phone" class="input">
        @else
        <label class="profile_text" for="profile_phone">Telefon</label>
            <input type="text" id="profile_phone" wire:model="profile_phone" class="input" disabled>
        @endif
    </div>

    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_hobbies">Actualizeaza hobbies</label>
            <input type="text" id="profile_hobbies" wire:model="profile_hobbies" class="input">
        @else
            <label class="profile_text" for="profile_hobbies">Hobbies</label>
            <input type="text" id="profile_hobbies" wire:model="profile_hobbies" class="input" disabled>
        @endif
    </div>


    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_birthday">Actualizeaza ziua de nastere</label>
            <input type="date" id="profile_birthday" wire:model="profile_birthday" class="input">
        @else
            <label class="profile_text" for="profile_birthday">Ziua de nastere</label>
            <input type="date" id="profile_birthday" wire:model="profile_birthday" class="input" disabled>
        @endif
    </div>


    <div class="profile_group_label">

        @if($view == 0)
            <label class="profile_text" for="profile_gender">Actualizeaza sex</label>
            <select name="" id="profile_gender" wire:model="profile_gender" class="input">
                <option value="1">Barbat</option>
                <option value="2">Femeie</option>
                <option value="3">Altceva</option>
            </select>
        @else
            <label class="profile_text" for="profile_gender">Actualizeaza sex</label>
            <select name="" id="profile_gender" wire:model="profile_gender" class="input" disabled>
                <option value="1">Barbat</option>
                <option value="2">Femeie</option>
                <option value="3">Altceva</option>
            </select>
        @endif
    </div>

    <div class="profile_group_label">

        @if($view == 0)
            <label class="profile_text" for="profile_address">Actualizeaza adresa</label>
            <input type="text" id="profile_address" wire:model="profile_address" class="input">
        @else
            <label class="profile_text" for="profile_address">Actualizeaza adresa</label>
            <input type="text" id="profile_address" wire:model="profile_address" class="input" disabled>
        @endif
    </div>

    <div class="profile_group_label">
        @if($view == 0)
            <label class="profile_text" for="profile_about">Actualizeaza descrierea ta</label>
            <textarea name="" id="profile_about" cols="30" rows="20" wire:model="profile_about" class="input select"></textarea>
        @else
            <label class="profile_text" for="profile_about">Actualizeaza descrierea ta</label>
            <textarea name="" id="profile_about" cols="30" rows="20" wire:model="profile_about" class="input select" disabled></textarea>
        @endif
    </div>
    @if($view == 0)
        <div class="mod_profile_btn" wire:click="saveProfile" class="button-login">Actualizeaza profil</div>
        </div>
    @endif
</div>