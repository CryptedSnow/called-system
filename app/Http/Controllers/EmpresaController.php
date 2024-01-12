<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\{EmpresaModel,ChamadoModel};
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = EmpresaModel::orderBy('id')->paginate(5);
        return view('empresa.empresa', compact('empresa'));
    }

    public function create()
    {
        return view('empresa.create');
    }

    public function store(EmpresaRequest $request)
    {
        $validacoes = $request->validated();
        $dados_tratados = [
            'nome_fantasia' => trim((string) $validacoes['nome_fantasia']),
            'cnpj_empresa' => trim((string) $validacoes['cnpj_empresa']),
        ];
        EmpresaModel::create($dados_tratados);
        Log::channel('daily')->notice("Empresa $request->nome_fantasia está presente no sistema.");
        return redirect('empresa')->with('store',"Empresa $request->nome_fantasia está presente no sistema.");
    }

    public function edit($id)
    {
        $empresa = EmpresaModel::find($id);
        return view('empresa.update', compact(['empresa']));
    }

    public function update(EmpresaRequest $request, $id)
    {
        $validacoes = $request->validated();
        $dados_tratados = [
            'nome_fantasia' => trim((string) $validacoes['nome_fantasia']),
            'cnpj_empresa' => trim((string) $validacoes['cnpj_empresa']),
        ];
        EmpresaModel::where('id', $id)->update($dados_tratados);
        Log::channel('daily')->info("Empresa $request->nome_fantasia obteve atualização em suas informações.");
        return redirect('empresa')->with('update',"Empresa $request->nome_fantasia obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $nome_empresa = EmpresaModel::where('id','=',$id)->value('nome_fantasia');
        EmpresaModel::where('id', $id)->delete();
        Log::channel('daily')->warning("Empresa $nome_empresa agora está na lixeira.");
        return redirect('empresa')->with('trash',"Empresa $nome_empresa agora está na lixeira.");
    }

    public function trashEmpresa()
    {
        $empresa = EmpresaModel::onlyTrashed()->paginate(5);
        return view('empresa.trash-empresa', compact('empresa'));
    }

    public function restoreEmpresa($id)
    {
        $nome_empresa = EmpresaModel::onlyTrashed()->find($id)->nome_fantasia;
        $empresa = EmpresaModel::onlyTrashed()->find($id);
        $empresa->restore();
        Log::channel('daily')->notice("Empresa $nome_empresa retornou a listagem de empresas.");
        return redirect('trash-empresa')->with('restored',"Empresa $nome_empresa retornou a listagem de empresas.");
    }

    public function deleteEmpresa($id)
    {
        $nome = EmpresaModel::onlyTrashed()->find($id)->nome_fantasia;
        $empresa = EmpresaModel::onlyTrashed()->find($id);
        $quantidade_empresas = ChamadoModel::where('empresa_id', $id)->count();
        if ($quantidade_empresas > 0) {
            Log::channel('daily')->error("Não é possível excluir essa empresa permanentemente, pois essa empresa está associado em $quantidade_empresas registro(s) de chamados.");
            return redirect('trash-empresa')->with('error',"Não é possível excluir essa empresa permanentemente, pois essa empresa está associado em $quantidade_empresas registro(s) de chamados.");
        }
        $empresa->forceDelete();
        Log::channel('daily')->alert("Empresa $nome foi excluído permanentemente do sistema.");
        return redirect('trash-empresa')->with('destroy',"Empresa $nome foi excluído permanentemente do sistema.");
    }

    public function searchEmpresa(Request $request)
    {
        $filtro = $request->input('search');
        $empresa = EmpresaModel::query()->where('nome_fantasia', 'LIKE', "%$filtro%")->paginate(5);
        return view('empresa.empresa', compact('empresa'));
    }

    public function searchEmpresaTrash(Request $request)
    {
        $filtro = $request->input('search');
        $empresa = EmpresaModel::onlyTrashed()->where('nome_fantasia', 'LIKE', "%$filtro%")->paginate(5);
        return view('empresa.trash-empresa', compact('empresa'));
    }

}
