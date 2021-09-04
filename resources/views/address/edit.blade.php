@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('address.update', $address->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        Adicionar URL
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control" id="url" placeholder="https://example.com" name="url" value="{{ $address->description }}" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-outline-primary">Gravar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection