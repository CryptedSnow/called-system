@extends('layouts.app')
@section('title') {{"Atualizar $empresa->nome_fantasia"}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __("Atualizar $empresa->nome_fantasia") }}
                    <a href="{{ url("empresa") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url("update-empresa/$empresa->id") }}">
                        @csrf @method('PATCH')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome fantasia') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nome_fantasia') is-invalid @enderror" name="nome_fantasia" value="{{ $empresa->nome_fantasia }}">

                                @error('nome_fantasia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('CNPJ') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('cnpj_empresa') is-invalid @enderror" name="cnpj_empresa" value="{{ $empresa->cnpj_empresa }}">

                                @error('cnpj_empresa')
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
