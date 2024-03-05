<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class RoleForm extends Component
{
    public string $name;
    public bool $updateMode = false;
    public int $id;

    /** @var Collection<Permission> */
    public Collection $permissions;

    /** @var array<string> */
    public array $permissionIds = [];

    // Validation Rules
    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function render()
    {
        return view('livewire.role-form');
    }

    public function resetFields(): void
    {
        $this->name = '';
    }

    public function store()
    {
        // Validate  Request
        $this->validate();

        try {
            $role = Role::create([
               'name' => $this->name,
               'guard_name' => 'web',
            ]);

            $role->syncPermissions($this->permissionIds);

            // Set Flash Message
            session()->flash('success', 'Role created successfully');

        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->resetFields();
        //how to redirect
    }

    public function edit(int $id): void
    {
        $role = Role::findOrFail($id);

        $this->name = $role->name;
        $this->updateMode = true;
    }

    public function update(): void
    {
        $this->validate();

        try {
            $role = Role::findOrFail($this->id);

            $role->update([
                'name' => $this->name,
            ]);

            // Set Flash Message
            session()->flash('success', 'Role updated successfully');


        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->updateMode = false;
        $this->resetFields();
    }

}
