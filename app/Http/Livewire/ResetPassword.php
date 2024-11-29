<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResetPassword extends Component
{
    use LivewireAlert;
    public $newpassword, $oldpassword, $user, $not_found, $not_found_msg;

    public function mount()
    {
        $user_id = Auth::user()->id;
        $this->user = User::findOrFail($user_id);
        $this->not_found_msg = "Password Lama Tidak Sesuai!";
    }

    public function render()
    {
        return view('livewire.reset-password')->extends('layouts.app');
    }

    public function updatedOldpassword()
    {
        $this->reset('not_found');
        if (Hash::check($this->oldpassword, $this->user->password)) {
            $this->not_found = FALSE;
        } else {
            $this->not_found = TRUE;
        }
    }

    public function store()
    {
        $this->validate(['newpassword' => 'required|min:8']);

        $this->user->fill([
            'password' => Hash::make($this->newpassword)
        ])->save();

        $this->alert('success', 'Password Berhasil Direset!', ['position' => 'top']);
        $this->reset('oldpassword', 'newpassword', 'not_found');
    }
}
