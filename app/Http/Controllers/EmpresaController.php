<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\{Empresa, Chamado};
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::with('chamado')->paginate(5);
        return view('empresa.empresa', compact('empresa'));
    }

    public function create()
    {
        return view('empresa.create');
    }

    public function store(EmpresaRequest $request)
    {
        Empresa::create($request->validated());
        Log::channel('daily')->notice("Empresa $request->nome_fantasia está presente no sistema.");
        return redirect()->route('empresa')->with('store',"Empresa $request->nome_fantasia está presente no sistema.");
    }

    public function edit($id)
    {
        $empresa = Empresa::find($id);
        return view('empresa.update', compact('empresa'));
    }

    public function update(EmpresaRequest $request, $id)
    {
        Empresa::where('id', $id)->update($request->validated());
        Log::channel('daily')->info("Empresa $request->nome_fantasia obteve atualização em suas informações.");
        return redirect()->route('empresa')->with('update',"Empresa $request->nome_fantasia obteve atualização em suas informações.");
    }

    public function destroy($id)
    {
        $nome_empresa = Empresa::where('id', $id)->value('nome_fantasia');
        Empresa::where('id', $id)->delete();
        Log::channel('daily')->warning("Empresa $nome_empresa agora está na lixeira.");
        return redirect()->route('empresa')->with('trash',"Empresa $nome_empresa agora está na lixeira.");
    }

    public function trashEmpresa()
    {
        $empresa = Empresa::with('chamado')->onlyTrashed()->paginate(5);
        return view('empresa.trash-empresa', compact('empresa'));
    }

    public function restoreEmpresa($id)
    {
        $nome_empresa = Empresa::onlyTrashed()->find($id)->nome_fantasia;
        $empresa = Empresa::onlyTrashed()->find($id);
        $empresa->restore();
        Log::channel('daily')->notice("Empresa $nome_empresa retornou a listagem de empresas.");
        return redirect()->route('trashEmpresa')->with('restored',"Empresa $nome_empresa retornou a listagem de empresas.");
    }

    public function deleteEmpresa($id)
    {
        $nome = Empresa::onlyTrashed()->find($id)->nome_fantasia;
        $empresa = Empresa::onlyTrashed()->find($id);
        $quantidade_empresas = Chamado::where('empresa_id', $id)->count();
        if ($quantidade_empresas > 0) {
            Log::channel('daily')->error("Não é possível excluir essa empresa permanentemente, pois essa empresa está associado em $quantidade_empresas registro(s) de chamados.");
            return redirect()->route('trashEmpresa')->with('error',"Não é possível excluir essa empresa permanentemente, pois essa empresa está associado em $quantidade_empresas registro(s) de chamados.");
        }
        $empresa->forceDelete();
        Log::channel('daily')->alert("Empresa $nome foi excluído permanentemente do sistema.");
        return redirect()->route('trashEmpresa')->with('destroy',"Empresa $nome foi excluído permanentemente do sistema.");
    }

    public function searchEmpresa(Request $request)
    {
        $filtro = $request->input('search');
        $empresa = Empresa::query()->where('nome_fantasia', 'LIKE', "%$filtro%")->with('chamado')->paginate(5);
        return view('empresa.empresa', compact('empresa'));
    }

    public function searchEmpresaTrash(Request $request)
    {
        $filtro = $request->input('search');
        $empresa = Empresa::onlyTrashed()->where('nome_fantasia', 'LIKE', "%$filtro%")->with('chamado')->paginate(5);
        return view('empresa.trash-empresa', compact('empresa'));
    }

}
