<?php

namespace App\Http\Controllers;

use App\Enum\{GravidadeChamadoEnum, StatusChamadoEnum};
use App\Http\Requests\ChamadoRequest;
use App\Models\{Empresa, Chamado};
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $chamado = Chamado::with('empresa')->orderBy('created_at', 'desc')->paginate(5);
        } else {
            $empresa_id = $user->empresas()->pluck('empresas.id');
            $chamado = Chamado::whereIn('empresa_id', $empresa_id)->with('empresa')->orderBy('created_at', 'desc')->paginate(5);
        }
        return view('chamado.chamado', compact('chamado'));
    }

    public function create()
    {
        $user = Auth::user();
        $empresa = $user->hasRole('Admin') ? Empresa::orderBy('id')->get() : $user->empresas()->orderBy('id')->get();
        $gravidade = GravidadeChamadoEnum::options();
        $status = StatusChamadoEnum::options();
        return view('chamado.create', compact(['empresa','gravidade','status']));
    }

    public function store(ChamadoRequest $request)
    {
        Chamado::create($request->validated());
        Log::channel('daily')->notice("Chamado $request->titulo está presente no sistema.");
        return redirect()->route('chamado')->with('store',"Chamado $request->titulo está presente no sistema.");
    }

    public function edit($id)
    {
        $user = Auth::user();
        $query = Chamado::with('empresa')->orderBy('id')->get();
        if (!$user->hasRole('Admin')) {
            $empresa_id = $user->empresas()->pluck('empresas.id');
            $query->whereIn('empresa_id', $empresa_id);
        }
        $chamado = $query->find($id);
        $empresa = $user->hasRole('Admin') ? Empresa::orderBy('id')->get() : $user->empresas()->orderBy('id')->get();
        $gravidade = GravidadeChamadoEnum::options();
        $status = StatusChamadoEnum::options();
        return view('chamado.update', compact(['chamado','empresa','gravidade','status']));
    }

    public function update(ChamadoRequest $request, $id)
    {
        Chamado::where('id', $id)->update($request->validated());
        Log::channel('daily')->info("Chamado $request->titulo obteve atualização em suas informações.");
        return redirect()->route('chamado')->with('update',"Chamado $request->titulo obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $titulo_chamado = Chamado::where('id', $id)->value('titulo');
        Chamado::where('id', $id)->delete();
        Log::channel('daily')->warning("Chamado $titulo_chamado agora está na lixeira.");
        return redirect()->route('chamado')->with('trash',"Chamado $titulo_chamado agora está na lixeira.");
    }

    public function trashChamado()
    {
        $user = Auth::user();
        $query = Chamado::onlyTrashed()->with('empresa')->orderBy('created_at', 'desc');
        if (!$user->hasRole('Admin')) {
            $empresa_id = $user->empresas()->pluck('empresas.id');
            $query->whereIn('empresa_id', $empresa_id);
        }
        $chamado = $query->paginate(5);
        return view('chamado.trash-chamado', compact('chamado'));
    }

    public function restoreChamado($id)
    {
        $titulo = Chamado::onlyTrashed()->find($id)->titulo;
        $chamado = Chamado::onlyTrashed()->find($id);
        $chamado->restore();
        Log::channel('daily')->notice("Chamado $titulo retornou a listagem de chamados.");
        return redirect()->route('trashChamado')->with('restored',"Chamado $titulo retornou a listagem de chamados.");
    }

    public function deleteChamado($id)
    {
        $titulo = Chamado::onlyTrashed()->find($id)->titulo;
        $chamado = Chamado::onlyTrashed()->find($id);
        $chamado->forceDelete();
        Log::channel('daily')->alert("Chamado $titulo foi excluído permanentemente do sistema.");
        return redirect()->route('trashChamado')->with('destroy',"Chamado $titulo foi excluído permanentemente do sistema.");
    }

    public function searchChamado(Request $request)
    {
        $user = Auth::user();
        $filtro = $request->input('search');
        $query = Chamado::with('empresa')->whereAny(['titulo', 'descricao'], 'LIKE', "%{$filtro}%");
        if (!$user->hasRole('Admin')) {
            $empresa_id = $user->empresas()->pluck('empresas.id');
            $query->whereIn('empresa_id', $empresa_id);
        }
        $chamado = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('chamado.chamado', compact('chamado'));
    }

    public function searchChamadoTrash(Request $request)
    {
        $user = Auth::user();
        $filtro = $request->input('search');
        $query = Chamado::with('empresa')->whereAny(['titulo', 'descricao'], 'LIKE', "%{$filtro}%")->onlyTrashed();
        if (!$user->hasRole('Admin')) {
            $empresa_id = $user->empresas()->pluck('empresas.id');
            $query->whereIn('empresa_id', $empresa_id);
        }
        $chamado = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('chamado.trash-chamado', compact('chamado'));
    }

}
