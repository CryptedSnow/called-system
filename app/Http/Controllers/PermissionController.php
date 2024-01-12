<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::paginate(5);
        return view('permission.permission', compact(['permission']));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(PermissionRequest $request)
    {
        Permission::create(array_map('trim', $request->validated()));
        Log::channel('daily')->notice("A permissão $request->name está presente no sistema.");
        return redirect('permission')->with('store',"A permissão $request->name está presente no sistema.");
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.update', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        Permission::where('id', $id)->update(array_map('trim', $request->validated()));
        Log::channel('daily')->info("A permissão $request->name obteve atualização em suas informações.");
        return redirect('permission')->with('update',"A permissão $request->name obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $nome = Permission::where('id', '=', $id)->value('name');
        Permission::where('id', $id)->delete();
        Log::channel('daily')->warning("A permissão $nome agora está na lixeira.");
        return redirect('permission')->with('trash',"A permissão $nome agora está na lixeira.");
    }

    public function searchPermission(Request $request)
    {
        $filtro = $request->input('search');
        $permission = Permission::query()->where('name', 'LIKE', "%$filtro%")->paginate(5);
        return view('permission.permission', compact('permission'));
    }

    public function searchPermissionTrash(Request $request)
    {
        $filtro = $request->input('search');
        $permission = Permission::onlyTrashed()->where('name', 'LIKE', "%$filtro%")->paginate(5);
        return view('permission.trash-permission', compact('permission'));
    }

    public function trashPermission()
    {
        $permission = Permission::onlyTrashed()->paginate(5);
        return view('permission.trash-permission', compact('permission'));
    }

    public function restorePermissionTrash($id)
    {
        $nome = Permission::onlyTrashed()->find($id)->name;
        $permission = Permission::onlyTrashed()->find($id);
        $permission->restore();
        Log::channel('daily')->notice("A permissão $nome retornou a listagem de permissões.");
        return redirect('trash-permission')->with('restored',"A permissão $nome retornou a listagem de permissões.");
    }

    public function deletePermissionTrash($id)
    {
        $nome = Permission::onlyTrashed()->find($id)->name;
        $permission = Permission::onlyTrashed()->find($id);
        $permission->forceDelete();
        Log::channel('daily')->alert("A permissão $nome foi excluído permanentemente do sistema.");
        return redirect('trash-permission')->with('destroy',"A permissão $nome foi excluído permanentemente do sistema.");
    }

}
