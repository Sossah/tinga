@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-success fw-bold"><i class="fas fa-tachometer-alt me-2"></i>Tableau de bord</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    
    </div>
</div>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- STATISTIQUES -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 py-2 overflow-hidden position-relative">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small text-uppercase fw-bold text-success mb-1">
                            Total d'agents</div>
                        <div class="h5 mb-0 fw-bold">{{ $totalAgents }}</div>
                        <div class="mt-2 small text-muted">
                            <span class="text-success me-2"> Nombres d'agents</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-users fa-2x text-success opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="bg-success position-absolute top-0 start-0 h-100" style="width: 5px;"></div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 py-2 overflow-hidden position-relative">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small text-uppercase fw-bold text-success mb-1">
                            Total de Souscriptions</div>
                        <div class="h5 mb-0 fw-bold">{{$totalSouscriptions}}</div>
                        <div class="mt-2 small text-muted">
                            <span class="text-warning me-2"><i class="fas fa-clock"></i> En progression</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-clipboard-list fa-2x text-success opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="bg-success position-absolute top-0 start-0 h-100" style="width: 5px;"></div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 py-2 overflow-hidden position-relative">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small text-uppercase fw-bold text-success mb-1">
                            Revenus mensuels</div>
                        <div class="h5 mb-0 fw-bold">{{$revenuMensuel}} XOF</div>
                        <div class="mt-2 small text-muted">
                            <span class="text-success me-2"><i class="fas fa-arrow-up"></i>  {{$pourcentageRevenu}} %</span>
                            <span>Depuis le mois dernier</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-dollar-sign fa-2x text-success opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="bg-success position-absolute top-0 start-0 h-100" style="width: 5px;"></div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 py-2 overflow-hidden position-relative">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small text-uppercase fw-bold text-success mb-1">
                            Demandes en attente</div>
                        <div class="h5 mb-0 fw-bold">{{$souscriptionsEnAttente}}</div>
                        <div class="mt-2 small text-muted">
                            <span class="text-warning me-2"><i class="fas fa-hourglass-half"></i> À traiter</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-comments fa-2x text-success opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="bg-success position-absolute top-0 start-0 h-100" style="width: 5px;"></div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                <h6 class="m-0 fw-bold text-success"><i class="fas fa-chart-line me-2"></i>Evolution des Souscriptions</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-link text-muted" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Télécharger PDF</a></li>
                        <li><a class="dropdown-item" href="#">Exporter données</a></li>
                        <li><a class="dropdown-item" href="#">Actualiser</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 300px;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                <h6 class="m-0 fw-bold text-success"><i class="fas fa-chart-pie me-2"></i>Répartition par régions</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-link text-muted" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="#">Télécharger PDF</a></li>
                        <li><a class="dropdown-item" href="#">Exporter données</a></li>
                        <li><a class="dropdown-item" href="#">Actualiser</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 300px;">
                    <canvas id="projectsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- transaction récent-->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
        <h6 class="m-0 fw-bold text-success"><i class="fas fa-exchange-alt me-2"></i>Dernières Souscriptions</h6>
        <a href="{{ route('souscriptions.index') }}" class="btn btn-sm btn-success rounded-pill px-3">Voir tout</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" width="100%" cellspacing="0">
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
                    @forelse(App\Models\Souscription::with('abonne')->latest()->take(2)->get() as $souscription)
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
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune souscription trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
<style>
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
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activity Chart
        var activityCtx = document.getElementById('activityChart').getContext('2d');
        var activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($moisLabels) !!},
                datasets: [{
                    label: 'Souscriptions',
                    data: {!! json_encode($souscriptionsParMois) !!},
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
 // Projects Chart
 // Projects Chart
 var projectsCtx = document.getElementById('projectsChart').getContext('2d');
        var projectsChart = new Chart(projectsCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($regionsLabels) !!},
                datasets: [{
                    data: {!! json_encode($souscriptionsParRegion) !!},
                    backgroundColor: [
                        'rgb(46, 148, 59)',     // Vert foncé - Maritime
                        'rgb(247, 216, 40)',    // Jaune - Plateaux
                        'rgb(140, 245, 39)',    // Vert clair - Centrale
                        'rgb(52, 104, 2)',      // Vert très foncé - Kara
                        'rgb(110, 171, 117)'    // Vert moyen - Savane
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