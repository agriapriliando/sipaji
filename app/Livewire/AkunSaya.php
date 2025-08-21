<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;


class AkunSaya extends Component
{
    #[Validate('required|string|max:100')]
    public $name = '';

    #[Validate('required|string|max:50')]
    public $username = '';

    #[Validate('required|email|max:100')]
    public $email = '';

    #[Validate('nullable|string|min:6|confirmed')]
    public $password = '';

    public $password_confirmation = '';
    public $passwordMatch = true;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function updated($property)
    {
        if (in_array($property, ['password', 'password_confirmation'])) {
            $this->checkPasswordMatch();
        }
    }

    public function checkPasswordMatch()
    {
        $this->passwordMatch = $this->password === $this->password_confirmation;
    }

    public function update()
    {
        $this->validate();

        $user = User::find(Auth::id());

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('success', 'Akun berhasil diperbarui ✅');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:100|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function render()
    {
        return view('livewire.akun-saya');
    }
}
