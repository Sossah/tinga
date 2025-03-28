@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-success mb-4">Résultats de recherche pour "{{ $query }}"</h2>
    
    @if($users->count() > 0)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="m-0 fw-bold">Utilisateurs</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Ajoutez d'autres sections pour d'autres types de résultats -->
    
    @if($users->count() == 0)
    <div class="alert alert-info col-md-6">
        Aucun résultat trouvé pour "{{ $query }}".
    </div>
    @endif
    
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Retour
    </a>
</div>
@endsection