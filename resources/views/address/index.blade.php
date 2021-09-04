@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Sucesso!</strong> {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Erro!</strong> {{ session('error') }}
    </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Cadastro URL
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('address.create') }}" type="button" class="btn btn-outline-success">Adicionar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <list-table url="{{ route('address.index') }}"></list-table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection