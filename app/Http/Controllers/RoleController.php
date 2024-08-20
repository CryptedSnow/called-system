<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\{Permission,Role};
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::paginate(5);
        return view('role.role', compact(['role']));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('role.create', compact(['permissions']));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());
        $permissions = $request->input('permissions', []);
        $permission_id = Permission::whereIn('name', $permissions)->pluck('id')->all();
        $role->permissions()->attach($permission_id);
        Log::channel('daily')->notice("O papel $request->name está presente no sistema.");
        return redirect('role')->with('store',"O papel $request->name está presente no sistema.");
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('name')->get();
        $roles = Role::where('id', $id)->get();
        return view('role.update', compact(['role','permissions','roles']));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->validated());
        $permissions = $request->input('permissions', []);
        $permission_id = Permission::whereIn('name', $permissions)->pluck('id')->all();
        $role->permissions()->sync($permission_id);
        Log::channel('daily')->info("O papel $request->name obteve atualização em suas informações.");
        return redirect('role')->with('update',"O papel $request->name obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $nome = Role::where('id', '=', $id)->value('name');
        Role::where('id', $id)->delete();
        Log::channel('daily')->warning("O papel $nome agora está na lixeira.");
        return redirect('role')->with('trash',"O papel $nome agora está na lixeira.");
    }

    public function searchRole(Request $request)
    {
        $filtro = $request->input('search');
        $role = Role::query()->where('name', 'LIKE', "%$filtro%")->paginate(5);
        return view('role.role', compact('role'));
    }

    public function searchRoleTrash(Request $request)
    {
        $filtro = $request->input('search');
        $role = Role::onlyTrashed()->where('name', 'LIKE', "%$filtro%")->paginate(5);
        return view('role.trash-role', compact('role'));
    }

    public function trashRole()
    {
        $role = Role::onlyTrashed()->paginate(5);
        return view('role.trash-role', compact('role'));
    }

    public function restoreRoleTrash($id)
    {
        $nome = Role::onlyTrashed()->find($id)->name;
        $role = Role::onlyTrashed()->find($id);
        $role->restore();
        Log::channel('daily')->notice("O papel $nome retornou a listagem de papéis.");
        return redirect('trash-role')->with('restored',"O papel $nome retornou a listagem de papéis.");
    }

    public function deleteRoleTrash($id)
    {
        $nome = Role::onlyTrashed()->find($id)->name;
        $role = Role::onlyTrashed()->find($id);
        $role->forceDelete();
        Log::channel('daily')->alert("O papel $nome foi excluído permanentemente do sistema.");
        return redirect('trash-role')->with('destroy',"O papel $nome foi excluído permanentemente do sistema.");
    }

}
