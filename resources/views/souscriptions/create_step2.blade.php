@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Nouvelle Souscription - Étape 2/2</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted">Informations de l'abonné</span>
                            <span class="text-success fw-bold">Détails de la souscription</span>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('souscriptions.store.step2') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="montant" class="form-label">Montant (FCFA) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" value="{{ old('montant') }}" required>
                                    @error('montant')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type_souscription" class="form-label">Type de souscription <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type_souscription') is-invalid @enderror" id="type_souscription" name="type_souscription" required>
                                        <option value="">Sélectionner</option>
                                        <option value="2_fils" {{ old('type_souscription') == '2_fils' ? 'selected' : '' }}>2 fils</option>
                                        <option value="4_fils" {{ old('type_souscription') == '4_fils' ? 'selected' : '' }}>4 fils</option>
                                    </select>
                                    @error('type_souscription')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amperes" class="form-label">Ampèrage <span class="text-danger">*</span></label>
                                    <select class="form-select @error('amperes') is-invalid @enderror" id="amperes" name="amperes" required>
                                        <option value="">Sélectionner</option>
                                        @for ($i = 5; $i <= 60; $i += 5)
                                            <option value="{{ $i }}" {{ old('amperes') == $i ? 'selected' : '' }}>{{ $i }} ampères</option>
                                        @endfor
                                    </select>
                                    @error('amperes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="commentaire" class="form-label">Commentaire</label>
                                    <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" name="commentaire" rows="3">{{ old('commentaire') }}</textarea>
                                    @error('commentaire')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('souscriptions.create') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-1"></i> Finaliser la souscription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection