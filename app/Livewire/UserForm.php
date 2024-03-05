<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as AuthUser;

class UserForm extends Component
{
    public string $name;
    public string $email;
    public string $password;
    public bool $updateMode = false;
    public int $id;
    public int $role;

    /** @var Collection<Role> */
    public Collection $roles;

    // Validation Rules
    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:100',
        'password' => 'required|min:4',
        'role' => 'required|exists:roles,id',
    ];

    public function render()
    {
        return view('livewire.user-form');
    }

    public function resetFields(): void
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function store()
    {
        // Validate  Request
        $this->validate();

        try {
            //create user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $user->assignRole($this->role);

            // Set Flash Message
            session()->flash('success', 'User created successfully');

        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->resetFields();
        //how to redirect
    }

    public function edit(int $id): void
    {
        $user = User::findOrFail($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->updateMode = true;
    }

    public function update(): void
    {
        $this->validate();

        try {
            $user = User::findOrFail($this->id);

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            // Set Flash Message
            session()->flash('success', 'User updated successfully');


        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->updateMode = false;
        $this->resetFields();
    }

}
