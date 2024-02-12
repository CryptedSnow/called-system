<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChamadoRequest;
use App\Models\{EmpresaModel,ChamadoModel,GravidadeModel};
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamado = ChamadoModel::orderBy('id')->paginate(5);
        return view('chamado.chamado', compact('chamado'));
    }

    public function create()
    {
        $empresa = EmpresaModel::orderBy('id')->get();
        $gravidade = GravidadeModel::orderBy('id')->get();
        return view('chamado.create', compact(['empresa','gravidade']));
    }

    public function store(ChamadoRequest $request)
    {
        $validacoes = $request->validated();
        $dados_tratados = [
            'empresa_id' => (int) $validacoes['empresa_id'],
            'titulo' => trim((string) $validacoes['titulo']),
            'descricao' => trim((string) $validacoes['descricao']),
            'gravidade_id' => (int) $validacoes['gravidade_id'],
            'status' => trim((string) $validacoes['status']),
        ];
        ChamadoModel::create($dados_tratados);
        Log::channel('daily')->notice("Chamado $request->titulo está presente no sistema.");
        return redirect('chamado')->with('store',"Chamado $request->titulo está presente no sistema.");
    }

    public function edit($id)
    {
        $chamado = ChamadoModel::find($id);
        $empresa = EmpresaModel::orderBy('id')->get();
        $gravidade = GravidadeModel::orderBy('id')->get();
        return view('chamado.update', compact(['chamado','empresa','gravidade']));
    }

    public function update(ChamadoRequest $request, $id)
    {
        $validacoes = $request->validated();
        $dados_tratados = [
            'empresa_id' => (int) $validacoes['empresa_id'],
            'titulo' => trim((string) $validacoes['titulo']),
            'descricao' => trim((string) $validacoes['descricao']),
            'gravidade_id' => (int) $validacoes['gravidade_id'],
            'status' => trim((string) $validacoes['status']),
        ];
        ChamadoModel::where('id', $id)->update($dados_tratados);
        Log::channel('daily')->info("Chamado $request->titulo obteve atualização em suas informações.");
        return redirect('chamado')->with('update',"Chamado $request->titulo obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $titulo_chamado = ChamadoModel::where('id','=',$id)->value('titulo');
        ChamadoModel::where('id', $id)->delete();
        Log::channel('daily')->warning("Chamado $titulo_chamado agora está na lixeira.");
        return redirect('chamado')->with('trash',"Chamado $titulo_chamado agora está na lixeira.");
    }

    public function trashChamado()
    {
        $chamado = ChamadoModel::onlyTrashed()->paginate(5);
        return view('chamado.trash-chamado', compact('chamado'));
    }

    public function restoreChamado($id)
    {
        $titulo = ChamadoModel::onlyTrashed()->find($id)->titulo;
        $chamado = ChamadoModel::onlyTrashed()->find($id);
        $chamado->restore();
        Log::channel('daily')->notice("Chamado $titulo retornou a listagem de chamados.");
        return redirect('trash-chamado')->with('restored',"Chamado $titulo retornou a listagem de chamados.");
    }

    public function deleteChamado($id)
    {
        $titulo = ChamadoModel::onlyTrashed()->find($id)->titulo;
        $chamado = ChamadoModel::onlyTrashed()->find($id);
        $chamado->forceDelete();
        Log::channel('daily')->alert("Chamado $titulo foi excluído permanentemente do sistema.");
        return redirect('trash-chamado')->with('destroy',"Chamado $titulo foi excluído permanentemente do sistema.");
    }

    public function searchChamado(Request $request)
    {
        $filtro = $request->input('search');
        $chamado = ChamadoModel::select('chamados.*', 'empresas.*','gravidades.*')
        ->join('empresas', 'chamados.empresa_id', '=', 'empresas.id')
        ->join('gravidades', 'chamados.gravidade_id', '=', 'gravidades.id')
        ->where('empresas.nome_fantasia', 'LIKE', "%$filtro%")
        ->orWhere('chamados.titulo', 'LIKE', "%$filtro%")
        ->orWhere('chamados.descricao', 'LIKE', "%$filtro%")->paginate(5);
        return view('chamado.chamado', compact('chamado'));
    }

    public function searchChamadoTrash(Request $request)
    {
        $filtro = $request->input('search');
        $chamado = ChamadoModel::select('chamados.*', 'empresas.*','gravidades.*')
        ->join('empresas', 'chamados.empresa_id', '=', 'empresas.id')
        ->join('gravidades', 'chamados.gravidade_id', '=', 'gravidades.id')
        ->where('empresas.nome_fantasia', 'LIKE', "%$filtro%")
        ->orWhere('chamados.titulo', 'LIKE', "%$filtro%")
        ->orWhere('chamados.descricao', 'LIKE', "%$filtro%")->onlyTrashed()->paginate(5);
        return view('chamado.trash-chamado', compact('chamado'));
    }

}
