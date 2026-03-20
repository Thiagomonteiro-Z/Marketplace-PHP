@extends("layouts.app")

@section("content")
<h1>Editar Loja</h1>
    <form action="{{ route('admin.stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="form-group">
                <label for="name">Nome da Loja:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $store->name) }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $store->description) }}">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $store->phone) }}">
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group m">
                <label for="mobile_phone">Celular/WhatsApp</label>
                <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ old('mobile_phone', $store->mobile_phone) }}">
                @error('mobile_phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <p ">
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" style="max-width: 150px;">
                </p>
                <label for="logo">Logo:</label>
                <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                @error('logo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success">Atualizar Loja</button>
            </div>
        </div>
    </form>

@endsection
