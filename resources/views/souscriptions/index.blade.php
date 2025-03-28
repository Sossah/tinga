@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0">Gestion des souscriptions</h2>
        <a href="{{ route('souscriptions.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Nouvelle souscription
        </a>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead class="table-light">
                        <tr>
                            <th>Numéro</th>
                            <th>Abonné</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Ville</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($souscriptions as $souscription)
                        <tr>
                            <td>{{ $souscription->numero }}</td>
                            <td>{{ $souscription->abonne->prenom }} {{ $souscription->abonne->nom }}</td>
                            <td>{{ number_format($souscription->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $souscription->type_souscription }}</td>
                            <td>{{ $souscription->abonne->ville }}</td>
                            <td>
                                @if($souscription->statut == 'en_attente')
                                <span class="badge bg-warning">En attente</span>
                                @elseif($souscription->statut == 'validee')
                                <span class="badge bg-success">Validée</span>
                                @elseif($souscription->statut == 'rejetee')
                                <span class="badge bg-danger">Rejetée</span>
                                @endif
                            </td>
                            <td>{{ $souscription->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('souscriptions.show', $souscription->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($souscription->canBeEdited())
                                        <a href="{{ route('souscriptions.edit', $souscription->id) }}" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('souscriptions.validate', $souscription->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item text-success" onclick="return confirm('Êtes-vous sûr de vouloir valider cette souscription?');">
                                                            <i class="fas fa-check-circle me-1"></i> Valider
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('souscriptions.reject', $souscription->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette souscription?');">
                                                            <i class="fas fa-times-circle me-1"></i> Rejeter
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    <form action="{{ route('souscriptions.destroy', $souscription->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette souscription?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    // Faire disparaître l'alerte de succès après 4 secondes
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").fadeOut('slow');
        }, 4000); // 4000 millisecondes = 4 secondes
    });
</script>
@endsection