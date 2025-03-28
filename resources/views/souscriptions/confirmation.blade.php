@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="mb-3">Souscription enrégistrée avec succès</h4>
                    <p class="mb-4">Demande enregistrée. Voici les détails de votre souscription:</p>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Numéro de souscription:</p>
                                            <h6 class="fw-bold">{{ $souscription->numero }}</h6>
                                        </div>
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Abonné:</p>
                                            <h6 class="fw-bold">{{ $souscription->abonne->prenom }} {{ $souscription->abonne->nom }}</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Montant:</p>
                                            <h6 class="fw-bold">{{ number_format($souscription->montant, 0, ',', ' ') }} FCFA</h6>
                                        </div>
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Type:</p>
                                            <h6 class="fw-bold">
                                                @if($souscription->type_souscription == '4_ans')
                                                    Souscription sur 4 ans
                                                @elseif($souscription->type_souscription == '10_ans')
                                                    Souscription sur 10 ans
                                                @else
                                                    {{ $souscription->type_souscription }}
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Statut:</p>
                                            <h6><span class="badge bg-warning">En attente de validation</span></h6>
                                        </div>
                                        <div class="col-md-6 text-start">
                                            <p class="text-muted mb-1">Date:</p>
                                            <h6 class="fw-bold">{{ $souscription->created_at->format('d/m/Y H:i') }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mb-4 w-75 mx-auto py-2">
                        <i class="fas fa-info-circle me-2"></i>
                        Demande à annalyser pour validation.
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('souscriptions.index') }}" class="btn btn-success">
                            <i class="fas fa-list me-1"></i> Voir toutes les souscriptions
                        </a>
                        <a href="{{ route('souscriptions.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-1"></i> Nouvelle souscription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection