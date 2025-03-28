@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="m-0 fw-bold text-success">Nouvelle Souscription - Étape 1/2</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-success fw-bold">Informations de l'abonné</span>
                            <span class="text-muted">Détails de la souscription</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('souscriptions.store.step1') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ville" class="form-label">Ville <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" value="{{ old('ville') }}" required>
                                    @error('ville')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="region" class="form-label">Région <span class="text-danger">*</span></label>
                                    <select class="form-select @error('region') is-invalid @enderror" id="region" name="region" required>
                                        <option value="">Sélectionner</option>
                                        <option value="Maritime" {{ old('region') == 'Maritime' ? 'selected' : '' }}>Maritime</option>
                                        <option value="Plateaux" {{ old('region') == 'Plateaux' ? 'selected' : '' }}>Plateaux</option>
                                        <option value="Centrale" {{ old('region') == 'Centrale' ? 'selected' : '' }}>Centrale</option>
                                        <option value="Kara" {{ old('region') == 'Kara' ? 'selected' : '' }}>Kara</option>
                                        <option value="Savane" {{ old('region') == 'Savane' ? 'selected' : '' }}>Savane</option>
                                    </select>
                                    @error('region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession" value="{{ old('profession') }}">
                                    @error('profession')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                    @error('date_naissance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                                    <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" required>
                                        <option value="">Sélectionner</option>
                                        <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                    @error('sexe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type_piece" class="form-label">Type de pièce <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type_piece') is-invalid @enderror" id="type_piece" name="type_piece" required>
                                        <option value="">Sélectionner</option>
                                        <option value="CNI" {{ old('type_piece') == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                                        <option value="Passeport" {{ old('type_piece') == 'Passeport' ? 'selected' : '' }}>Passeport</option>
                                        <option value="Permis" {{ old('type_piece') == 'Permis' ? 'selected' : '' }}>Permis de conduire</option>
                                        <option value="carte_electeur" {{ old('type_piece') == 'carte_electeur' ? 'selected' : '' }}>Carte d'électeur</option>
                                    </select>
                                    @error('type_piece')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="numero_piece" class="form-label">Numéro de pièce <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('numero_piece') is-invalid @enderror" id="numero_piece" name="numero_piece" value="{{ old('numero_piece') }}" required>
                                    @error('numero_piece')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('souscriptions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                Continuer <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection