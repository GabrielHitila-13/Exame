<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestão de Oficinas')</title>
    <link rel="icon" href="@yield('favicon', 'favicon.ico')" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .main-container {
            flex: 1;
            padding: 20px;
            margin-top: 80px;
        }

        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .data-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .action-btn {
            padding: 6px 12px;
            margin: 2px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .hover-shadow {
            transition: box-shadow 0.3s ease;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('portal.index') }}">
            <img src="logo.png" alt="" height="30" class="d-inline-block align-top">
            Gestão de Oficinas
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item"><a class="nav-link active" href="{{ route('portal.index') }}">Portal</a></li>

                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Gerenciar Usuários</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('servicos.index') }}">Gerenciar Serviços</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Criar Contas</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                    @endif

                    @if(Auth::user()->role == 'secretario')
                        <li class="nav-item"><a class="nav-link" href="{{ route('secretario.dashboard') }}">Dashboards</a></li>
                    @endif

                    @if(Auth::user()->role == 'tecnico')
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboards.tecnico') }}">Dashboards</a></li>
                    @endif

                    @if(Auth::user()->role == 'cliente')
                        <li class="nav-item"><a class="nav-link" href="{{ route('cliente.dashboard') }}">Recursos</a></li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo Principal -->
<main class="main-container">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Bootstrap 5 JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Função para confirmação de exclusão
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja excluir este registro?')) {
                    e.preventDefault();
                }
            });
        });
    });

    // Filtro de pesquisa na tabela
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('dataTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 0; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td')[1];
            if (td) {
                const txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }

    // Validação de formulário
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
</body>
</html>
