@extends('layouts.front')

@section('content')
    <h2 class="alert alert-success">
        Pedido processado com sucesso!
    </h2>
    <h3>
        Seu pedido código do pedido é: {{ request()->get('order') }}.
    </h3>


@endsection
