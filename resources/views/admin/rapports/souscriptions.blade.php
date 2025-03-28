@extends('layouts.app')

@section('content')
<div class="rapport-detail-container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success fw-bold"><i class="fas fa-file-invoice me-2"></i>Rapport des Souscriptions</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-success">
                <i class="fas fa-share-alt me-1"></i> Partager
            </button>
                <button type="button" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-download me-1"></i> Exporter PDF
                </button>
            </div>
            <a href="{{ route('rapports.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-success">Filtrer les données</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('rapports.souscriptions') }}" method="GET">
                        <div class="col-md-3">
                            <label class="form-label">Période</label>
                            <select class="form-select" name="periode" id="periode">
                                <option value="mois" {{ request('periode') == 'mois' ? 'selected' : '' }}>Ce mois</option>
                                <option value="trimestre" {{ request('periode') == 'trimestre' ? 'selected' : '' }}>Ce trimestre</option>
                                <option value="annee" {{ request('periode') == 'annee' ? 'selected' : '' }}>Cette année</option>
                                <option value="personnalise" {{ request('periode') == 'personnalise' ? 'selected' : '' }}>Personnalisé</option>
                            </select>
                        </div>
                        
                        <!-- Champs cachés pour les dates personnalisées -->
                        <input type="hidden" name="date_debut" id="date_debut" value="{{ request('date_debut') }}">
                        <input type="hidden" name="date_fin" id="date_fin" value="{{ request('date_fin') }}">
                        <div class="col-md-3">
                            <label class="form-label">Région</label>
                            <select class="form-select" name="region" id="region">
                                <option value="">Toutes les régions</option>
                                <option value="Maritime" {{ request('region') == 'Maritime' ? 'selected' : '' }}>Maritime</option>
                                <option value="Plateaux" {{ request('region') == 'Plateaux' ? 'selected' : '' }}>Plateaux</option>
                                <option value="Centrale" {{ request('region') == 'Centrale' ? 'selected' : '' }}>Centrale</option>
                                <option value="Kara" {{ request('region') == 'Kara' ? 'selected' : '' }}>Kara</option>
                                <option value="Savane" {{ request('region') == 'Savane' ? 'selected' : '' }}>Savane</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Statut</label>
                            <select class="form-select" name="statut" id="statut">
                                <option value="">Tous les statuts</option>
                                <option value="validee" {{ request('statut') == 'validee' ? 'selected' : '' }}>Validée</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="rejetee" {{ request('statut') == 'rejetee' ? 'selected' : '' }}>Rejetée</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-filter me-2"></i>Appliquer les filtres
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-success">Détails des souscriptions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="souscriptionsTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Numéro</th>
                            <th>Abonné</th>
                            <th>Région</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($souscriptions as $souscription)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $souscription->numero }}</strong></td>
                            <td>{{ $souscription->abonne->nom ?? 'N/A' }} {{ $souscription->abonne->prenom ?? '' }}</td>
                            <td>{{ $souscription->abonne->region ?? $souscription->abonne->ville ?? 'N/A' }}</td>
                            <td>
                                @if($souscription->statut == 'validee')
                                    <span class="badge bg-success rounded-pill">Validée</span>
                                @elseif($souscription->statut == 'en_attente')
                                    <span class="badge bg-warning rounded-pill">En attente</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">Rejetée</span>
                                @endif
                            </td>
                            <td>{{ $souscription->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('souscriptions.show', $souscription->id) }}" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></a>
                                    @if($souscription->canBeEdited())
                                    <a href="{{ route('souscriptions.edit', $souscription->id) }}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>
                                    @endif
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

<!-- Modal pour la sélection de dates personnalisées -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="dateRangeModalLabel">Sélectionner une période personnalisée</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="modalDateDebut" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="modalDateDebut">
                    </div>
                    <div class="col-md-6">
                        <label for="modalDateFin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="modalDateFin">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="applyDateRange">Appliquer</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .rapport-detail-container {
        position: relative;
        min-height: 80vh;
        padding: 20px;
        z-index: 1;
    }
    
    .rapport-detail-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/fond-souscriptions.jpg');
        background-size: cover;
        background-position: center;
        opacity: 0.05;
        z-index: -1;
    }
    
    .card {
        border-radius: 0.75rem;
        transition: transform 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .badge {
        padding: 0.5em 0.75em;
    }
    
    .border-bottom {
        border-color: rgba(46, 148, 59, 0.2) !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation de DataTable
        $('#souscriptionsTable').DataTable({
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
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
        });
        
        // Gestion du modal pour la période personnalisée
        const periodeSelect = document.getElementById('periode');
        const dateDebutInput = document.getElementById('date_debut');
        const dateFinInput = document.getElementById('date_fin');
        const modalDateDebut = document.getElementById('modalDateDebut');
        const modalDateFin = document.getElementById('modalDateFin');
        const applyDateRangeBtn = document.getElementById('applyDateRange');
        const dateRangeModal = new bootstrap.Modal(document.getElementById('dateRangeModal'));
        
        // Initialiser les dates du modal si elles existent déjà
        if (dateDebutInput.value) {
            modalDateDebut.value = dateDebutInput.value;
        }
        if (dateFinInput.value) {
            modalDateFin.value = dateFinInput.value;
        }
        
        // Ouvrir le modal quand "Personnalisé" est sélectionné
        periodeSelect.addEventListener('change', function() {
            if (this.value === 'personnalise') {
                dateRangeModal.show();
            }
        });
        
        // Si "Personnalisé" est déjà sélectionné au chargement et qu'aucune date n'est définie
        if (periodeSelect.value === 'personnalise' && (!dateDebutInput.value || !dateFinInput.value)) {
            dateRangeModal.show();
        }
        
        // Appliquer les dates sélectionnées
        applyDateRangeBtn.addEventListener('click', function() {
            if (modalDateDebut.value && modalDateFin.value) {
                dateDebutInput.value = modalDateDebut.value;
                dateFinInput.value = modalDateFin.value;
                dateRangeModal.hide();
                
                // Soumettre automatiquement le formulaire si les deux dates sont sélectionnées
                if (dateDebutInput.closest('form')) {
                    dateDebutInput.closest('form').submit();
                }
            } else {
                alert('Veuillez sélectionner une date de début et une date de fin.');
            }
        });
        
        // Graphique d'évolution des souscriptions
        var souscriptionsCtx = document.getElementById('souscriptionsChart').getContext('2d');
        var souscriptionsChart = new Chart(souscriptionsCtx, {
            type: 'line',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Souscriptions',
                    data: [12, 19, 15, 25, 22, 30],
                    backgroundColor: 'rgba(46, 148, 59, 0.1)',
                    borderColor: 'rgb(46, 148, 59)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgb(46, 148, 59)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Graphique de répartition par statut
        var statutCtx = document.getElementById('statutChart').getContext('2d');
        var statutChart = new Chart(statutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Validée', 'En attente', 'Rejetée'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: [
                        'rgb(46, 148, 59)',
                        'rgb(255, 193, 7)',
                        'rgb(220, 53, 69)'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.raw || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '60%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
</script>
@endpush
@endsection