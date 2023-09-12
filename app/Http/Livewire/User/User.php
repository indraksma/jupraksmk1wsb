<?php

namespace App\Http\Livewire\User;

use App\Models\User as ModelUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.user.user', ['user' => ModelUser::latest()->paginate(10)])->extends('layouts.app');
    }
}
