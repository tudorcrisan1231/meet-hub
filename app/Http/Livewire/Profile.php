<?php

namespace App\Http\Livewire;

use App\Models\Theme;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img,  $profile_name, $profile_phone, $profile_birthday, $profile_gender, $profile_address, $profile_about, $current_img, $profile_hobbies=[], $existing_hobbies=[];
    public $view = 0; //0 = my profile, 1 = other profile
    public $themes;
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
        $user->hobbies = $this->profile_hobbies;

        $user->save();

        return redirect()->to('/');
    }

    public function mount(){
        if(isset($_GET['user']) && $_GET['user'] != auth()->user()->id){
            $user = User::find($_GET['user']);
            $this->view = 1;
        } else {
            $user = User::find(auth()->user()->id);
            $this->view = 0;
        }
        
        $this->current_img = $user->photo;
        $this->profile_name = $user->name;
        $this->profile_phone = $user->phone;
        $this->profile_birthday = $user->birthday;
        $this->profile_gender = $user->gender;
        $this->profile_address = $user->address;
        $this->profile_about = $user->about;
        $this->existing_hobbies = $user->hobbies;

        $this->themes = Theme::all();

    }

    public function render()
    {
        return view('livewire.profile');
    }
}
