@extends("layouts.app")

@section("content")
    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success mb-3">Criar Nova Categoria</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="justify-content-center">
        {{-- $categories->links() --}}
    </div>


@endsection
