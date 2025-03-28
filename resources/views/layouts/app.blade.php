<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('styles')
    
    <style>
        :root {
            --primary-color: #117a1a;
            --secondary-color: #f8f9fc;
            --accent-color: #f5e720;
            --text-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fc;
        }
        
        .sidebar {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 1;
        }
        
        .sidebar .nav-link {
            color: #6c757d;
            padding: 0.75rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(17, 122, 26, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background-color: var(--primary-color);
        }
        
        .sidebar .nav-link.active i {
            color: white;
        }
        
        .sidebar .nav-link i {
            color: var(--primary-color);
        }
        
        .navbar-brand {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            font-size: 1rem;
            background-color: var(--primary-color);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
        
        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-nav .nav-item .nav-link {
            color: var(--text-color);
        }
        
        .navbar-nav .nav-item .nav-link:hover {
            color: var(--primary-color);
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1000;
                padding: 0;
                overflow-x: hidden;
                overflow-y: auto;
            }
        }
        
        /* DataTables Custom Styling */
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .page-link {
            color: var(--primary-color);
        }
        
        .dataTables_info, .dataTables_length, .dataTables_filter label {
            font-size: 0.80rem;
        }
        
        .dataTables_length select, .dataTables_filter input {
            font-size: 0.80rem;
        }
        
        /* Couleur des liens dans les tableaux */
        .data-table a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .data-table a:hover {
            color: var(--primary-color);
            text-decoration: no-underline;
        }
        
        /* Style pour le message défilant */
        .marquee-container {
            flex-grow: 1;
            overflow: hidden;
            white-space: nowrap;
            margin-right: 20px;
        }
        
        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 20s linear infinite;
            font-weight: 500;
        }
        
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <header class="navbar navbar-light sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white fs-3 fw-bold" href="#">{{ config('fond tinga', 'Fonds Tinga') }}</a>
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="marquee-container d-none d-md-block">
            <div class="marquee-text text-success">
                <i class="fas fa-info-circle me-2"></i> <span class="fw-semibold">Bienvenue sur la plateforme de gestion du Fonds Tinga</span> - Ensemble pour un avenir énergétique durable.
            </div>
        </div>
        
        <div class="d-flex align-items-center me-3">
            <div class="position-relative me-3" style="max-width: 300px;">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control form-control-sm rounded-pill" type="text" name="query" placeholder="Rechercher..." aria-label="Search">
                        <button type="submit" class="btn btn-sm position-absolute top-0 end-0 h-100 bg-transparent border-0">
                            <i class="fas fa-search text-muted small"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="nav-item dropdown">
                <a class="nav-link px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Utilisateur' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>Mon profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </a>
                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // Script pour initialiser DataTables sur tous les tableaux avec la classe 'data-table'
        $(document).ready(function() {
            $('.data-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
                    lengthMenu: "_MENU_",
                    info: "_START_ à _END_ sur _TOTAL_",
                    search: "",
                    searchPlaceholder: "Rechercher...",
                    zeroRecords: "Aucun résultat",
                    infoEmpty: "0 enregistrement",
                    infoFiltered: "(filtrés depuis _MAX_ enregistrements)",
                    paginate: {
                        previous: '<i class="fas fa-chevron-left"></i>',
                        next: '<i class="fas fa-chevron-right"></i>'
                    }
                },
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: -1 } // Désactive le tri sur la dernière colonne (actions)
                ],
                pageLength: 7,
                lengthMenu: [[7, 15, 25, -1], [7, 15, 25, "Tous"]],
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
            });
        });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>