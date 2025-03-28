@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">Gestion des Utilisateurs</h2>
        @can('create users')
        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="fas fa-user-plus me-1"></i> Nouvel Utilisateur
        </a>
        @endcan
    </div>

    @if ($message = Session::get('success'))
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert" id="successAlert">
                <i class="fas fa-check-circle me-1"></i> {{ $message }}
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover data-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rôles</th>
                                    <th width="150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'Non renseigné' }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-success">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('users.show', $user->id) }}" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                   
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('users.edit', $user->id) }}" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                
                                    
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                   
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Modales de confirmation de suppression -->
    @foreach ($users as $user)
    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer l'utilisateur <strong>{{ $user->name }}</strong> ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    // Faire disparaître l'alerte de succès après 4 secondes
    $(document).ready(function() {
        setTimeout(function() {
            $("#successAlert").fadeOut('slow');
        }, 4000); // 4000 millisecondes = 4 secondes
    });
</script>
@endsection