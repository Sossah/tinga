@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-2 border-0 d-flex align-items-center">
                    <div class="me-3">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; overflow: hidden;">
                            <i class="fas fa-user text-success" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <h5 class="m-0 fw-bold text-success">Détails de l'utilisateur: {{ $user->name }}</h5>
                </div>
                <div class="card-body py-2">
                    <div class="mb-2">
                        <h6 class="fw-bold mb-1">Nom:</h6>
                        <p class="mb-2">{{ $user->name }}</p>
                    </div>

                    <div class="mb-2">
                        <h6 class="fw-bold mb-1">Email:</h6>
                        <p class="mb-2">{{ $user->email }}</p>
                    </div>

                    <div class="mb-2">
                        <h6 class="fw-bold mb-1">Téléphone:</h6>
                        <p class="mb-2">{{ $user->phone ?? 'Non renseigné' }}</p>
                    </div>

                    <div class="mb-2">
                        <h6 class="fw-bold mb-1">Adresse:</h6>
                        <p class="mb-2">{{ $user->address ?? 'Non renseignée' }}</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Rôles:</h6>
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
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                        @can('edit users')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
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