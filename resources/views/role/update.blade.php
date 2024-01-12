@extends('layouts.app')
@section('title') {{"Atualizar papel: $role->name"}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __("Atualizar papel: $role->name") }}
                    <a href="{{ url("role") }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url("update-role/$role->id") }}">
                        @csrf @method('PATCH')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Papel') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control @error('name') is-invalid @enderror" name="name">
                                    @foreach($roles as $r)
                                    <option value="{{ $r->name }}" {{ $role->name == $r->name ? 'selected' : '' }}>
                                        {{ $r->name }}
                                    </option>
                                @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Permissão') }} <span class="required"> *</label>

                            <div class="col-md-6">
                                <select class="form-control js-example-basic-multiple @error('permissions') is-invalid @enderror" name="permissions[]" multiple>
                                    @foreach($permissions as $p)
                                        <option {{ $role->permissions->contains('name', $p->name) ? 'selected' : '' }} value="{{ $p->name }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
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
