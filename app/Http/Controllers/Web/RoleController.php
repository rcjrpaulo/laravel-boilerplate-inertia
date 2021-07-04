<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Roles\DestroyRolesService;
use App\Services\Roles\ListRolesService;
use App\Services\Roles\StoreRolesService;
use App\Services\Roles\UpdateRolesService;
use Inertia\Inertia;

class RoleController extends Controller
{

    public function index()
    {
        $this->authorize('read_roles');

        $roles = (new ListRolesService())->run(
            request()->query(),
            [],
            request()->get('pagination', true),
            request()->get('items_per_page', 20)
        );
    
        return Inertia::render('Role/Index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create_roles');

        return Inertia::render('Role/Create');
    }

    public function store(StoreRoleRequest $storeRoleRequest)
    {
        $this->authorize('create_roles');

        $role = (new StoreRolesService())->run($storeRoleRequest->validated());

        session()->flash('success', 'Papel criado com sucesso !');

        return redirect(route('roles.show', $role));
    }

    public function show(Role $role)
    {
        $this->authorize('read_roles');

        return Inertia::render('Role/Show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('update_roles');

        $groupPermissions = Permission::get()->groupBy('group_label');
        $role->array_permissions = $role->permissions->pluck('id')->toArray();
    
        return Inertia::render('Role/Edit', compact('role', 'groupPermissions'));
    }

    public function update(UpdateRoleRequest $updateRoleRequest, Role $role)
    {
        $this->authorize('update_roles');

        $role = (new UpdateRolesService())->run($role, $updateRoleRequest->validated());

        session()->flash('success', 'Papel atualizado com sucesso !');

        return redirect(route('roles.edit', $role));
    }

    public function destroy(Role $role)
    {
        (new DestroyRolesService())->run($role);

        session()->flash('success', 'Papel deletado com sucesso !');

        return redirect(route('roles.index'));
    }

    public function updatePermissions(Role $role)
    {
        $this->authorize('delete_roles');

        $role->permissions()->sync(request()->get('permissions', []));

        session()->flash('success', 'Permissões do papel atualizadas com sucesso !');

        return back();
    }
}
