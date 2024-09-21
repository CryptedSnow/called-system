@extends('layouts.app')
@section('title') {{"Atualizar chamado $chamado->titulo"}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __("Atualizar chamado $chamado->titulo") }}
                    <a href="{{ url("chamado") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url("update-chamado/$chamado->id") }}">
                        @csrf @method('PATCH')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control @error('empresa_id') is-invalid @enderror" name="empresa_id">
                                    @foreach($empresa as $e)
                                        <option {{ $chamado->empresa_id == $e->id ? 'selected' : '' }} value="{{ $e->id }}">{{ $e->nome_fantasia }}</option>
                                    @endforeach
                                </select>
                                @error('empresa_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Título') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ $chamado->titulo }}">

                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Descrição') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $chamado->descricao }}">

                                @error('descricao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Gravidade') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control @error('gravidade_id') is-invalid @enderror" name="gravidade_id">
                                    <option {{ $chamado->gravidade_id == '' ? 'selected' : '' }} value="">{{ __('Escolha a gravidade') }}</option>
                                    @foreach($gravidade as $g)
                                        <option {{ $chamado->gravidade_id == $g->id ? 'selected' : '' }} value="{{ $g->id }}">{{ $g->tipo_gravidade }}</option>
                                    @endforeach
                                </select>
                                @error('gravidade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Status') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="Andamento" {{ $chamado->status === 'Andamento' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="andamento">Andamento</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="Concluido" {{ $chamado->status === 'Concluido' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="concluido">Concluído</label>
                                </div>

                                @error('status')
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
