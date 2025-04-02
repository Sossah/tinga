@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0">Détails de la souscription</h2>
        <div>
            <a href="{{ route('souscriptions.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
            @if($souscription->statut != 'validee')
            <a href="{{ route('souscriptions.edit', $souscription->id) }}" class="btn btn-success">
                <i class="fas fa-edit me-1"></i> Modifier
            </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Informations de la souscription</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Numéro</div>
                            <div class="col-md-8 fw-bold">{{ $souscription->numero }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Montant</div>
                            <div class="col-md-8 fw-bold">{{ number_format($souscription->montant, 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Type</div>
                            <div class="col-md-8">{{ $souscription->type_souscription }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Ampèrage</div>
                            <div class="col-md-8">{{ $souscription->amperes }}</div>
                        </div>
                    </div>
                   
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Statut</div>
                            <div class="col-md-8">
                                @if($souscription->statut == 'en_attente')
                                <span class="badge bg-warning">En attente</span>
                                @elseif($souscription->statut == 'validee')
                                <span class="badge bg-success">Validée</span>
                                @elseif($souscription->statut == 'rejetee')
                                <span class="badge bg-danger">Rejetée</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Date de souscription</div>
                            <div class="col-md-8">{{ $souscription->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4 text-muted">Commentaire</div>
                            <div class="col-md-8">{{ $souscription->commentaire ?? 'Aucun commentaire' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Informations de l'abonné</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Nom complet</div>
                            <div class="col-md-8 fw-bold">{{ $souscription->abonne->prenom }} {{ $souscription->abonne->nom }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Email</div>
                            <div class="col-md-8">{{ $souscription->abonne->email }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Téléphone</div>
                            <div class="col-md-8">{{ $souscription->abonne->telephone }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Adresse</div>
                            <div class="col-md-8">{{ $souscription->abonne->adresse ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Ville</div>
                            <div class="col-md-8">{{ $souscription->abonne->ville ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Région</div>
                            <div class="col-md-8">{{ $souscription->abonne->region }}</div>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4 text-muted">Profession</div>
                            <div class="col-md-8">{{ $souscription->abonne->profession ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4 text-muted">Pièce d'identité</div>
                            <div class="col-md-8">
                                @if($souscription->abonne->type_piece && $souscription->abonne->numero_piece)
                                {{ $souscription->abonne->type_piece }} - {{ $souscription->abonne->numero_piece }}
                                @else
                                N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection