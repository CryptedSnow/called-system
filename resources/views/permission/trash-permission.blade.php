@extends('layouts.app')
@section('title') {{'Lixeira de permissões'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Lixeira de permissões') }}
                    <a href="{{ url("permission") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-permission-trash') }}" method="GET" class="form-inline">
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
                                <form method="POST" action="{{ url("delete-permission-trash/$p->id") }}">
                                  <a href="{{ url("restore-permission/$p->id") }}" class="btn btn-primary"><i class="fa fa-arrows-rotate"></i></a>
                                  @csrf @method('DELETE')
                                  {{-- <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button> --}}
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
