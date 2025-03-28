@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Détails du rôle: {{ $role->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Nom:</h6>
                        <p>{{ $role->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Permissions:</h6>
                        @if($rolePermissions->count() > 0)
                            <div class="row">
                                @foreach($rolePermissions as $permission)
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-success">{{ $permission->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Aucune permission attribuée</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                        @can('edit roles')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">
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