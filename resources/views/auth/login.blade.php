<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '') }} - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #117a1a;
            --secondary-color: #f8f9fc;
            --accent-color: #f5e720;
            --text-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text-color);
            background: url('https://www.ceet.tg/tg/wp-content/uploads/2024/07/Copie-de-_DSC2389.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }
        
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        
        .row {
            width: 80%;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            overflow: hidden;
            background-color: white;
        }
        
        .login-image {
            background: url('https://source.unsplash.com/random/800x600/?nature,green') no-repeat center center;
            background-size: cover;
            height: 500px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(17, 122, 26, 0.7) 0%, rgba(245, 231, 32, 0.4) 100%);
            z-index: 1;
        }
        
        /* Ajout de cette partie pour l'image */
        .login-image-content {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-image-content img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .login-form {
            padding: 2.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 500px;
            background-color: white;
        }
        
        .login-form form {
            width: 100%;
        }
        
        .login-form h2 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .login-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
            background-color: #f8f9fc;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(17, 122, 26, 0.25);
            background-color: white;
        }
        
        .input-group-text {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px 0 0 10px;
            width: 50px;
            display: flex;
            justify-content: center;
        }
        
        .btn-login {
            background: linear-gradient(to right, var(--primary-color), #0d5c14);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1.5rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .btn-login:hover {
            background: linear-gradient(to right, var(--accent-color), #d9cc1e);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 122, 26, 0.3);
        }
        
        .register-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-color);
            font-style: italic;
            font-weight: 500;
            padding-top: 1.5rem;
            border-top: 1px solid #eaeaea;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            color: #e74a3b;
        }
        
        .form-label {
            font-weight: 600;
            color: #4e4e4e;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .row {
                width: 95%;
                margin: 20px auto;
            }
            
            .login-form {
                padding: 2rem;
                height: auto;
            }
            
            .login-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="row">
            <div class="col-md-6 d-none d-md-block login-image">
                <div class="login-image-content">
                    <img src="{{ asset('images/481998375_946928507563128_5960212123241570211_n.jpg') }}" alt="Fonds Tinga">
                </div>
            </div>
            <div class="col-md-6 login-form mt-1">
                <h2>Bienvenue</h2>
                
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <!-- Reste inchangé -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class=" rounded form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class=" rounded form-control password-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Connexion
                    </button>
                </form>
                
                <div class="register-link">
                    Fonds Tinga pour vous servir.
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>