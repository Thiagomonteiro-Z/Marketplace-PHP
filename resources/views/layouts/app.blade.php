<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">MarketPlaceL12</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/stores*'))active @endif" aria-current="page" href="{{ route('admin.stores.index') }}">Lojas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/products*'))active @endif" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/categories*'))active @endif" href="{{ route('admin.categories.index') }}">Categorias</a>
                        </li>
                    </ul>
                    <li class="navbar-nav">
                        <span class="nav-link">{{ auth()->user()->name }} - </span>
                    </li>
                    <div class="d-flex">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('#logout-form').submit();">Sair</a>
                                <form id="logout-form" class="logout"  action="{{ route('logout') }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container">
        @include('layouts.partials')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
          const instance = bootstrap.Alert.getOrCreateInstance(alert);
          instance.close();
        });
      }, 4000);
    </script>
</body>

</html>
