@extends("layouts.app")

@section("content")
<h1>Editar Produto</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="form-group">
                <label for="name">Nome do Produto:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $product->description) }}">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
             <div class="form-group">
                <label for="body">Conteúdo:</label>
                <textarea type="text" name="body" id="body" cols="10" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body', $product->body) }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Preço:</label>
                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="categories[]" id="category" class="form-control @error('categories') is-invalid @enderror" multiple>
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Fotos do Produto:</label>
                <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                @error('photos.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
            </div>
        </div>
    </form>

    <hr>
    <div class="row">
        @foreach ($product->photos as $photo)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="Foto do Produto" class="img-fluid">
                <form action="{{ route('admin.photo.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photoName" value="{{ $photo->image }}">
                    <button type="submit" class="btn btn-danger btn-block mt-2"> Remover</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
