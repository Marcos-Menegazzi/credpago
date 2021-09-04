@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Visualizar URL
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control" id="url" name="url" value="{{ $address->description }}" disabled>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <form action="{{ route('address.destroy', $address->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection