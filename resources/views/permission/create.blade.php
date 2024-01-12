@extends('layouts.app')
@section('title') {{'Cadastrar permissão'}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Cadastrar permissão') }}
                    <a href="{{ url("permission") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('add-permission') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Permissão') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
