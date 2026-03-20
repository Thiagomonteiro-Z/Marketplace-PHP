@extends("layouts.app")

@section("content")
    @if (!$store)
        <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success mb-3">Criar Nova Loja</a>
    @else

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Loja</th>
                <th>Total de Produtos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->products->count() }}</td>
                <td>
                    <a href="{{route('admin.stores.edit', $store->id)}}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Remover</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
@endsection
