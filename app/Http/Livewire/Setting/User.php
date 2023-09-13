<?php

namespace App\Http\Livewire\Setting;

use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $isOpen = 0;
    public $user_id, $name, $nip, $identity, $email, $password, $roles;

    public function render()
    {
        return view('livewire.setting.user', [
            'user' => ModelUser::latest()->paginate(10),
            'role' => Role::all()
        ])->extends('layouts.app');
    }

    private function resetInputFields()
    {
        $this->reset(['user_id', 'name', 'nip', 'identity', 'email', 'password', 'roles']);
        $this->resetErrorBag();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        if($this->user_id != NULL)
        {
            $this->validate([
                'name'      => ['required'],
                'nip'    => ['required', 'numeric'],
                'email'   => ['required'],
                'roles'   => ['required'],
                'identity'   => ['required', 'numeric'],
            ], $messages);
        } else {
            $this->validate([
                'name'      => ['required'],
                'nip'    => ['required', 'numeric'],
                'email'   => ['required'],
                'roles'   => ['required'],
                'password'   => ['required'],
                'identity'   => ['required', 'numeric'],
            ], $messages);
        }

        if ($this->password == NULL) {
            $user = ModelUser::updateOrCreate(['id' => $this->user_id], [
                'name'      => $this->name,
                'nip'    => $this->nip,
                'email'   => $this->email,
                'identity'   => $this->identity,
            ]);
        } else {
            $user = ModelUser::updateOrCreate(['id' => $this->user_id], [
                'name'      => $this->name,
                'nip'    => $this->nip,
                'email'   => $this->email,
                'password' => Hash::make($this->password),
                'identity'   => $this->identity,
            ]);
        }
        $user->syncRoles([$this->roles]);

        $this->alert('success', $this->user_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = ModelUser::findOrFail($id);


        $this->user_id = $id;
        $this->name = $user->name;
        $this->nip = $user->nip;
        $this->identity = $user->identity;
        $this->email = $user->email;
        $this->roles = $user->roles()->first()->id;
        $this->openModal();
    }

    public function delete($id)
    {
        $sql = ModelUser::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
