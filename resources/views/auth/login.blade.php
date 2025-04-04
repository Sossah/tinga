<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '') }} - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #117a1a;
            --secondary-color: #f8f9fc;
            --accent-color: #f5e720;
            --text-color: #5a5c69;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background: url('https://www.ceet.tg/tg/wp-content/uploads/2024/07/Copie-de-_DSC2389.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        
        .login-form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .login-form-container h2 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .login-form-container h2::after {
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
            border-radius: 50px;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e3e6f0;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(17, 122, 26, 0.15);
            background-color: white;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .input-group-text {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px 0 0 50px;
            width: 50px;
            display: flex;
            justify-content: center;
        }
        

        .form-control {
            border-radius: 0 50px 50px 0;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e3e6f0;
            border-left: none;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-bottom: 0;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(17, 122, 26, 0.15);
            background-color: white;
        }
        
        .btn-login {
            background: linear-gradient(to right, var(--primary-color), #0d5c14);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1.5rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(17, 122, 26, 0.2);
        }
        
        .btn-login:hover {
            background: linear-gradient(to right, #0d5c14, var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(17, 122, 26, 0.3);
            color: var(--accent-color); /* Change le texte en jaune au survol */
        }
        
        .register-link {
            text-align: center;
            margin-top: 2rem;
            color: white;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            color: #e74a3b;
            padding-left: 1rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #4e4e4e;
            margin-bottom: 0.5rem;
            padding-left: 0.5rem;
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            
            .login-form-container {
                padding: 1.5rem;
            }
            
            .login-form-container h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form-container">
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
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                        <input id="password" type="password" class="form-control password-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
        </div>
        
        <div class="register-link mt-3">
            Fonds Tinga pour vous servir.
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>