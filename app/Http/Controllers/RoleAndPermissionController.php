<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Http\Requests\RoleAndPermission\StoreRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleAndPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roleandpermissions.index');
    }

    public function create()
    {
        return view('roleandpermissions.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $fields = $request->validated();
        Role::create($fields);

        return redirect()->route('roles.index')->with('success', 'Role has been added successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::where([
            'guard_name' => $role->guard_name
        ])->get();

        return view('roleandpermissions.edit')->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'guard_name' => 'required|string',
        ]);

        $role->update($validated);

        $permissions = $request->get('permissions', []);

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role was updated successfully.');
    }

}
