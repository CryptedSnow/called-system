@extends('layouts.app')
@section('title') {{"Atualizar usuário: $user->name"}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __("Atualizar usuário: $user->name") }}
                    <a href="{{ url("user") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url("update-user/$user->id") }}">
                        @csrf @method('PATCH')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Papel') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control js-example-basic-multiple @error('roles') is-invalid @enderror" name="roles[]" multiple>
                                    @foreach($roles as $r)
                                    <option {{ in_array($r->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }} value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control @error('empresa_id') is-invalid @enderror" name="empresa_id">
                                    <option {{ $user->empresa_id == '' ? 'selected' : '' }} value="">{{ __('Escolha a empresa') }}</option>
                                        @foreach($empresas as $e)
                                    <option {{ $user->empresa_id == $e->id ? 'selected' : '' }} value="{{ $e->id }}">{{ $e->nome_fantasia }}</option>
                                @endforeach
                                </select>
                                @error('empresa_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
