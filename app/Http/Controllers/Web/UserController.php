<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Users\ListUserService;
use App\Services\Users\StoreUserService;
use App\Services\Users\UpdateUserService;
use App\Services\Users\DestroyUserService;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('read_users');
    
        $users = (new ListUserService())->run(
            request()->query(),
            ['role'],
            request()->get('pagination', true),
            request()->get('items_per_page', 20)
        );
    
        return Inertia::render('User/Index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create_users');

        $roles = Role::get(['id', 'label']);
    
        return Inertia::render('User/Create', compact('roles'));
    }

    public function store(StoreUserRequest $storeUserRequest)
    {
        $this->authorize('create_users');

        $user = (new StoreUserService())->run($storeUserRequest->validated());

        session()->flash('success', 'Usuário criado com sucesso !');

        return redirect(route('users.show', $user));
    }

    public function show(User $user)
    {
        $this->authorize('read_users');
    
        $roles = Role::get(['id', 'label']);
    
        return Inertia::render('User/Create', compact('roles'));
    }

    public function edit(User $user)
    {
        $this->authorize('update_users');

        $roles = Role::get(['id', 'label']);

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        $this->authorize('update_users');

        $user = (new UpdateUserService())->run($user, $updateUserRequest->validated());

        session()->flash('success', 'Usuário atualizado com sucesso !');

        return redirect(route('users.edit', $user));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete_users');

        (new DestroyUserService())->run($user);

        session()->flash('success', 'Usuário deletado com sucesso !');

        return redirect(route('users.index'));
    }
}
