@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Détails de l'utilisateur: {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Nom:</h6>
                        <p>{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Email:</h6>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Téléphone:</h6>
                        <p>{{ $user->phone ?? 'Non renseigné' }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Adresse:</h6>
                        <p>{{ $user->address ?? 'Non renseignée' }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Rôles:</h6>
                        @if($user->roles->count() > 0)
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($user->roles as $role)
                                    <span class="badge bg-success">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Aucun rôle attribué</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                        @can('edit users')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Modifier
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection