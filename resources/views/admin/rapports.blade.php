@extends('layouts.app')

@section('content')
<div class="rapport-container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success fw-bold"><i class="fas fa-chart-bar me-2"></i>Rapports</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <a href="{{ route('rapports.souscriptions') }}" class="text-decoration-none">
                <div class="card rapport-card shadow-lg border-0 mb-4">
                    <div class="card-body text-center py-5">
                        <div class="rapport-icon mb-3">
                            <i class="fas fa-file-invoice fa-4x text-success"></i>
                        </div>
                        <h3 class="card-title fw-bold text-success">Rapport des Souscriptions</h3>
                        <p class="card-text text-muted">Consultez les statistiques détaillées des souscriptions par période, région et statut</p>
                        <button class="btn btn-success rounded-pill px-4 mt-3">
                            <i class="fas fa-chart-line me-2"></i>Voir le rapport
                        </button>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-5">
            <a href="{{ route('rapports.financiers') }}" class="text-decoration-none">
                <div class="card rapport-card shadow-lg border-0 mb-4">
                    <div class="card-body text-center py-5">
                        <div class="rapport-icon mb-3">
                            <i class="fas fa-money-bill-wave fa-4x text-success"></i>
                        </div>
                        <h3 class="card-title fw-bold text-success">Rapport Financier</h3>
                        <p class="card-text text-muted">Analysez les revenus, les tendances financières et les projections</p>
                        <button class="btn btn-success rounded-pill px-4 mt-3">
                            <i class="fas fa-chart-pie me-2"></i>Voir le rapport
                        </button>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>



@push('styles')
<style>
    .rapport-container {
        position: relative;
        min-height: 80vh;
        padding: 20px;
        z-index: 1;
    }
    
    .rapport-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://www.ceet.tg/tg/wp-content/uploads/2024/07/Copie-de-_DSC2401.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Fixe l'image pendant le défilement */
        opacity: 0.2; /* Augmenté de 0.1 à 0.2 pour plus de visibilité */
        z-index: -1;
    }
    
    .rapport-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.85); /* Légèrement plus transparent */
        overflow: hidden;
    }
    
    .rapport-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .rapport-card:hover .rapport-icon i {
        transform: scale(1.1);
    }
    
    .rapport-icon i {
        transition: all 0.3s ease;
    }
    
    .border-bottom {
        border-color: rgba(46, 148, 59, 0.2) !important;
    }
</style>
@endpush
@endsection