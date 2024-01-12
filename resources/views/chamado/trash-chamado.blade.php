@extends('layouts.app')
@section('title') {{'Lixeira de chamados'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Lixeira de chamados') }}
                    <a href="{{ url("chamado") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-chamado-trash') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar nome da empresa, título ou descrição do chamado">
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
                              <td> {{ $c->status }} </td>
                              <td>
                                <form method="POST" action="{{ url("delete-trash-chamado/$c->id") }}">
                                  <a href="{{ url("restore-chamado/$c->id") }}" class="btn btn-primary"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
                                  @csrf @method('DELETE')
                                  {{-- <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </button> --}}
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
