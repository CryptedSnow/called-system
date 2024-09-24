@extends('layouts.app')
@section('title') {{'Lista de chamados'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Lista de chamados') }}
                    <a href="{{ url("trash-chamado") }}" class="btn btn-danger" style="margin-left: 500px;"><i class="fa-solid fa-dumpster"></i>&nbsp;Lixeira</a>
                    <a href="{{ url("add-chamado") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-chamado') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar título ou descrição do chamado">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th> Empresa </th>
                            <th> Título </th>
                            <th> Descrição </th>
                            <th> Gravidade </th>
                            <th> Status </th>
                            <th> Data de criação </th>
                            <th> Ações </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($chamado as $c)
                            <tr>
                              <td> {{ $c->empresa->nome_fantasia }} </td>
                              <td> {{ $c->titulo }} </td>
                              <td> {{ $c->descricao }} </td>
                              <td> {{ $c->gravidade->tipo_gravidade }} </td>
                              <td>
                                <span class="badge rounded-pill
                                    {{ $c->status === 'Andamento' ? 'bg-danger' : ($c->status === 'Concluido' ? 'bg-success' : 'bg-dark') }}">
                                    {{ $c->status }}
                                </span>
                              </td>
                              <td> {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i:s') }} </td>
                              <td>
                                <form method="POST" action="{{ url("delete-chamado/$c->id") }}">
                                  <a href="{{ url("update-chamado/$c->id") }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                  @csrf @method('DELETE')
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{ $chamado->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
