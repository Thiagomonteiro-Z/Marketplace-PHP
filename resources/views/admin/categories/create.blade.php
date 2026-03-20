@extends("layouts.app")

@section("content")
<h1>Criar Nova Categoria</h1>
<form action="{{route('admin.categories.store')}}" method="POST">
    @csrf
    <div class="container">
        <div class="form-group">
            <label for="name">Nome da Categoria:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Criar Categoria</button>
        </div>
    </div>
</form>
@endsection
