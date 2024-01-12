<?php

namespace App\Http\Controllers;

use App\Http\Requests\{DetailsUserRequest,PasswordRequest,UserRequest};
use Illuminate\Support\Facades\{Auth,Hash};
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(5);
        return view('user.user', compact(['user']));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('user.create', compact(['roles']));
    }

    public function store(UserRequest $request)
    {
        $validacoes = $request->validated();
        $user = User::create([
            'name' => $validacoes['name'],
            'email' => $validacoes['email'],
            'password' => Hash::make($validacoes['password']),
        ]);
        $roles = Role::whereIn('name', $validacoes['roles'])->pluck('id')->toArray();
        $user->roles()->attach($roles);
        Log::channel('daily')->notice("Usuário(a) $request->name está presente no sistema.");
        return redirect('user')->with('store',"Usuário(a) $request->name está presente no sistema.");
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::orderBy('name')->get();
        return view('user.update', compact(['user','roles']));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $nome_user = User::where('id','=',$id)->value('name');
        $roles_names = $request->input('roles', []);
        $roles_id = Role::whereIn('name', $roles_names)->pluck('id');
        $user->roles()->sync($roles_id);
        Log::channel('daily')->info("Usuário(a) $nome_user recebeu modificação no sistema.");
        return redirect('user')->with('update',"Usuário(a) $nome_user recebeu modificação no sistema.");
    }

    public function destroy($id)
    {
        $nome = User::where('id','=',$id)->value('name');
        User::where('id',$id)->delete();
        Log::channel('daily')->warning("Usuário(a) $nome agora está na lixeira.");
        return redirect('user')->with('trash',"Usuário(a) $nome agora está na lixeira.");
    }

    public function trashUser()
    {
        $user = User::onlyTrashed()->paginate(5);
        return view('user.trash-user', compact('user'));
    }

    public function restoreUserTrash($id)
    {
        $nome = User::onlyTrashed()->find($id)->name;
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        Log::channel('daily')->notice("Usuário(a) $nome retornou a listagem de usuários.");
        return redirect('trash-user')->with('restored',"Usuário(a) $nome retornou a listagem de usuários.");
    }

    public function deleteUserTrash($id)
    {
        $nome = User::onlyTrashed()->find($id)->name;
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        Log::channel('daily')->alert("Usuário $nome foi excluído permanentemente do sistema.");
        return redirect('trash-user')->with('destroy',"Usuário $nome foi excluído(a) permanentemente do sistema.");
    }

    public function profile()
    {
        return view('profile.profile');
    }

    public function updateDetails(DetailsUserRequest $request)
    {
        $user = Str::words(Auth::user()->name, 1, '');
        $validacoes = $request->validated();
        User::whereId(Auth::user()->id)->update(['name' => $validacoes['name'], 'email' => $validacoes['email']]);
        return redirect('profile')->with('update',"Usuário(a) $user alterou suas informações pessoais.");
    }

    public function updatePassword(PasswordRequest $request)
    {
        $user = Str::words(Auth::user()->name, 1, '');
        $validacoes = $request->validated();
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($validacoes['confirm_password'])]);
        Log::channel('daily')->info("Usuário(a) $user recebeu modificação no sistema.");
        return redirect('profile')->with('update',"Usuário(a) $user alterou sua senha com sucesso.");
    }

}
