<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Component
{
    public string $name;
    public bool $updateMode = false;
    public int $id;

    // Validation Rules
    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function render()
    {
        return view('livewire.permission-form');
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
            Permission::create([
               'name' => $this->name,
               'guard_name' => 'web',
            ]);

            // Set Flash Message
            session()->flash('success', 'Permission created successfully');

        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->resetFields();
        //how to redirect
    }

    public function edit(int $id): void
    {
        $permission = Permission::findOrFail($id);

        $this->name = $permission->name;
        $this->updateMode = true;
    }

    public function update(): void
    {
        $this->validate();

        try {
            $permission = Permission::findOrFail($this->id);

            $permission->update([
                'name' => $this->name,
            ]);

            // Set Flash Message
            session()->flash('success', 'Permission updated successfully');


        } catch(\Exception $e) {
            session()->flash('error', 'Something goes wrong '. $e->getMessage());
        }

        $this->updateMode = false;
        $this->resetFields();
    }


}
