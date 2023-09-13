<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        // $role = Role::create(['guard_name' => 'web', 'name' => 'attendee']);
        //
        // $permission = Permission::create(['guard_name' => 'web', 'name' => 'buy tickets']);
        //
        // $role->givePermissionTo($permission);
    }
}
