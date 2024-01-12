@extends('layouts.app')
@section('title') {{'Lista de permissões'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Lista de permissões') }}
                    <a href="{{ url("trash-permission") }}" class="btn btn-danger" style="margin-left: 500px;"><i class="fa-solid fa-dumpster"></i>&nbsp;Lixeira</a>
                    <a href="{{ url("add-permission") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-permission') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar permissão">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th> Descrição </th>
                            <th> Ações </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($permission as $p)
                            <tr>
                              <td> {{ $p->name }} </td>
                              <td>
                                <form method="POST" action="{{ url("delete-permission/$p->id") }}">
                                  <a href="{{ url("update-permission/$p->id") }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Atualizar</a>
                                  @csrf @method('DELETE')
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{ $permission->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
