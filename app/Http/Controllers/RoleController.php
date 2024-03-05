<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('role.index');
    }

    public function create(): View
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }
}
