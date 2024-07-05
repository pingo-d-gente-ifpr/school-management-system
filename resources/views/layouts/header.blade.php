<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="{{ asset('assets/css/headers.css') }}">
</head>

<body>
    <header class="pheader bg-white d-flex py-3 px-3">

        <div class="d-lg-flex align-items-center navbar-height justify-content-center w-100 d-none">
            <form style="width: 50%;" class="search-form search-header d-flex align-items-center">
                <input id="filter_name" name="q" type="text" class="form-control pl-4 pr-0">
                <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="dropdown">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="mdo" width="32" height="32"
                    class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="#">Configurações</a></li>
                <li><a class="dropdown-item" href="/profile">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            {{ __('Sair') }}
                        </button>
                    </form>
                </li>

            </ul>
        </div>

    </header>
</body>
