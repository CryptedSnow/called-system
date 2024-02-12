@extends('layouts.app')
@section('title') {{'Lista de papéis'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Lista de papéis') }}
                    <a href="{{ url("trash-role") }}" class="btn btn-danger" style="margin-left: 520px;"><i class="fa-solid fa-dumpster"></i>&nbsp;Lixeira</a>
                    <a href="{{ url("add-role") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-role') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar papel">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th> Papel </th>
                            <th> Permissões </th>
                            <th> Ações </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($role as $r)
                            <tr>
                              <td> {{ $r->name }} </td>
                              <td>
                                @foreach($r->permissions->pluck('name') as $r2)
                                    <span class="badge rounded-pill bg-dark" title="{{ $r2 }}">{{ $r2 }}</span>
                                @endforeach
                              </td>
                              <td>
                                <form method="POST" action="{{ url("delete-role/$r->id") }}">
                                  <a href="{{ url("update-role/$r->id") }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                  @csrf @method('DELETE')
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{ $role->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
