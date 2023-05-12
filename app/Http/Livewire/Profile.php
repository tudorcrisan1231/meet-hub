<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img,  $profile_name, $profile_phone, $profile_birthday, $profile_gender, $profile_address, $profile_about, $current_img;

    public function saveProfile(){
        $user = User::find(auth()->user()->id);
        if($this->profile_img){
            $user->photo = $this->profile_img->store('photos', 'public');
        }
        $user->name = $this->profile_name;
        $user->phone = $this->profile_phone;
        $user->birthday = $this->profile_birthday;
        $user->gender = $this->profile_gender;
        $user->address = $this->profile_address;
        $user->about = $this->profile_about;

        $user->save();

        return redirect()->to('/');
    }

    public function boot(){
        $user = User::find(auth()->user()->id);
        $this->current_img = $user->photo;
        $this->profile_name = $user->name;
        $this->profile_phone = $user->phone;
        $this->profile_birthday = $user->birthday;
        $this->profile_gender = $user->gender;
        $this->profile_address = $user->address;
        $this->profile_about = $user->about;
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
