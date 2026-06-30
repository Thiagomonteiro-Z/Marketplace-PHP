@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.notifications.read.all') }}" class="btn btn-lg btn-success mb-3">Marcar todas como lidas!</a>
            <hr>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unreadNotifications as $n)
                <tr>
                    <td>{{ $n->data['message'] }}</td>
                    <td>{{ $n->created_at->locale('pt_BR')->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.notifications.read', $n->id) }}" class="btn btn-sm btn-primary">Marcar como lida</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" >
                        <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="justify-content-center">
        {{ $products->links() }}
    </div>


@endsection
