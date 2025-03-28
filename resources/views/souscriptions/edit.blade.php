@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0">Modifier la souscription</h2>
        <a href="{{ route('souscriptions.show', $souscription->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
    </div>

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('souscriptions.update', $souscription->id) }}">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Informations de la souscription -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="m-0 fw-bold text-success">Informations de la souscription</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numéro</label>
                            <input type="text" class="form-control" id="numero" value="{{ $souscription->numero }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" value="{{ old('montant', $souscription->montant) }}" required>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="type_souscription" class="form-label">Type de souscription <span class="text-danger">*</span></label>
                            <select class="form-select @error('type_souscription') is-invalid @enderror" id="type_souscription" name="type_souscription" required>
                                <option value="4_ans" {{ old('type_souscription', $souscription->type_souscription) == '4_ans' ? 'selected' : '' }}>Sur 4 ans</option>
                                <option value="10_ans" {{ old('type_souscription', $souscription->type_souscription) == '10_ans' ? 'selected' : '' }}>Sur 10 ans</option>
                            </select>
                            @error('type_souscription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut" name="date_debut" value="{{ old('date_debut', $souscription->date_debut ? date('Y-m-d', strtotime($souscription->date_debut)) : '') }}">
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                <option value="en_attente" {{ old('statut', $souscription->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="validee" {{ old('statut', $souscription->statut) == 'validee' ? 'selected' : '' }}>Validée</option>
                                <option value="rejetee" {{ old('statut', $souscription->statut) == 'rejetee' ? 'selected' : '' }}>Rejetée</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire</label>
                            <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" name="commentaire" rows="3">{{ old('commentaire', $souscription->commentaire) }}</textarea>
                            @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informations de l'abonné -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="m-0 fw-bold text-success">Informations de l'abonné</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="abonne_nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('abonne.nom') is-invalid @enderror" id="abonne_nom" name="abonne[nom]" value="{{ old('abonne.nom', $souscription->abonne->nom) }}" required>
                                @error('abonne.nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="abonne_prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('abonne.prenom') is-invalid @enderror" id="abonne_prenom" name="abonne[prenom]" value="{{ old('abonne.prenom', $souscription->abonne->prenom) }}" required>
                                @error('abonne.prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="abonne_email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('abonne.email') is-invalid @enderror" id="abonne_email" name="abonne[email]" value="{{ old('abonne.email', $souscription->abonne->email) }}" required>
                                @error('abonne.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="abonne_telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('abonne.telephone') is-invalid @enderror" id="abonne_telephone" name="abonne[telephone]" value="{{ old('abonne.telephone', $souscription->abonne->telephone) }}" required>
                                @error('abonne.telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="abonne_adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control @error('abonne.adresse') is-invalid @enderror" id="abonne_adresse" name="abonne[adresse]" value="{{ old('abonne.adresse', $souscription->abonne->adresse) }}">
                            @error('abonne.adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="abonne_ville" class="form-label">Ville</label>
                                <input type="text" class="form-control @error('abonne.ville') is-invalid @enderror" id="abonne_ville" name="abonne[ville]" value="{{ old('abonne.ville', $souscription->abonne->ville) }}">
                                @error('abonne.ville')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="abonne_regions" class="form-label">Région</label>
                                <input type="text" class="form-control @error('abonne.regions') is-invalid @enderror" id="abonne_regions" name="abonne[regions]" value="{{ old('abonne.regions', $souscription->abonne->regions) }}">
                                @error('abonne.regions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="abonne_profession" class="form-label">Profession</label>
                                <input type="text" class="form-control @error('abonne.profession') is-invalid @enderror" id="abonne_profession" name="abonne[profession]" value="{{ old('abonne.profession', $souscription->abonne->profession) }}">
                                @error('abonne.profession')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="abonne_date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control @error('abonne.date_naissance') is-invalid @enderror" id="abonne_date_naissance" name="abonne[date_naissance]" value="{{ old('abonne.date_naissance', $souscription->abonne->date_naissance ? date('Y-m-d', strtotime($souscription->abonne->date_naissance)) : '') }}">
                                @error('abonne.date_naissance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="abonne_sexe" class="form-label">Sexe</label>
                                <select class="form-select @error('abonne.sexe') is-invalid @enderror" id="abonne_sexe" name="abonne[sexe]">
                                    <option value="">Sélectionner</option>
                                    <option value="M" {{ old('abonne.sexe', $souscription->abonne->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('abonne.sexe', $souscription->abonne->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('abonne.sexe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="abonne_type_piece" class="form-label">Type de pièce</label>
                                <select class="form-select @error('abonne.type_piece') is-invalid @enderror" id="abonne_type_piece" name="abonne[type_piece]">
                                    <option value="">Sélectionner</option>
                                    <option value="CNI" {{ old('abonne.type_piece', $souscription->abonne->type_piece) == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                                    <option value="Passeport" {{ old('abonne.type_piece', $souscription->abonne->type_piece) == 'Passeport' ? 'selected' : '' }}>Passeport</option>
                                    <option value="Permis" {{ old('abonne.type_piece', $souscription->abonne->type_piece) == 'Permis' ? 'selected' : '' }}>Permis de conduire</option>
                                </select>
                                @error('abonne.type_piece')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="abonne_numero_piece" class="form-label">Numéro de pièce</label>
                                <input type="text" class="form-control @error('abonne.numero_piece') is-invalid @enderror" id="abonne_numero_piece" name="abonne[numero_piece]" value="{{ old('abonne.numero_piece', $souscription->abonne->numero_piece) }}">
                                @error('abonne.numero_piece')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection