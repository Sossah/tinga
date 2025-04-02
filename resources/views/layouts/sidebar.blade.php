<!-- Sidebar -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar position-fixed vh-100">
</br>
        <ul class="nav flex-column" id="sidebarAccordion">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Tableau de bord
                </a>
            </li>

            <!-- Souscriptions -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}" 
                   data-bs-toggle="collapse" href="#subscriptionsSubmenu">
                    <div><i class="fas fa-chart-bar me-2"></i> Souscriptions</div>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="subscriptionsSubmenu" data-bs-parent="#sidebarAccordion">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('subscriptions.create') ? 'active' : '' }}" href="{{ route('souscriptions.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Ajouter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('subscriptions.index') ? 'active' : '' }}" href="{{ route('souscriptions.index') }}">
                                <i class="fas fa-list me-2"></i> Liste
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Rapports -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('rapports.*') ? 'active' : '' }}" href="{{ route('rapports.index') }}">
                    <i class="fas fa-file-alt me-2"></i> Rapports
                </a>
            </li>

            <hr class="my-3">

            <!-- Section Compte -->
            <div class="sidebar-heading px-3 py-2 text-muted text-uppercase small fw-bold">
                Administration
            </div>

            <!-- Utilisateurs -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('users.*') || request()->routeIs('roles.*') || request()->routeIs('permissions.*') ? 'active' : '' }}" 
                   data-bs-toggle="collapse" href="#usersSubmenu">
                    <div><i class="fas fa-users me-2"></i> Utilisateurs</div>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="usersSubmenu" data-bs-parent="#sidebarAccordion">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">
                                <i class="fas fa-user-plus me-2"></i> Nouvel utilisateur
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i class="fas fa-list me-2"></i> Liste utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                <i class="fas fa-user-tag me-2"></i> Rôles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1 {{ request()->routeIs('permissions.index') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                                <i class="fas fa-key me-2"></i> Permissions
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <hr class="my-3">

        <!-- Section Compte -->
        <div class="sidebar-heading px-3 py-2 text-muted text-uppercase small fw-bold">
            Compte
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user me-2"></i> Mon profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
