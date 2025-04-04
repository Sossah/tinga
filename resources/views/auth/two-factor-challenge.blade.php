<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification à deux facteurs - Fonds Tinga</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://www.ceet.tg/tg/wp-content/uploads/2024/07/Copie-de-_DSC2389.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(233, 236, 239, 0.85) 100%);
            z-index: -1;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: none;
            overflow: hidden;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
        }
        .card-header {
            background: linear-gradient(135deg, #117a1a 0%, #1a9e25 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }
        .btn-success {
            background: linear-gradient(135deg, #117a1a 0%, #1a9e25 100%);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(17, 122, 26, 0.2);
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(17, 122, 26, 0.3);
            background: linear-gradient(135deg, #0e6315 0%, #158e1f 100%);
        }
        .btn-link {
            color: #117a1a;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-link:hover {
            color: #0e6315;
            text-decoration: underline;
        }
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            letter-spacing: 3px;
            font-size: 1.5rem;
        }
        .form-control:focus {
            border-color: #117a1a;
            box-shadow: 0 0 0 0.25rem rgba(17, 122, 26, 0.25);
        }
        .logo-container {
            background-color: white;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: -60px;
            position: relative;
            z-index: 10;
        }
        .verification-icon {
            font-size: 3rem;
            color: #117a1a;
            margin-bottom: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .alert {
            border-radius: 10px;
        }
        .invalid-feedback {
            margin-left: 10px;
        }
        .resend-container {
            border-top: 1px solid #e9ecef;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="m-0 fw-bold">Vérification à deux facteurs</h4>
                    </div>

                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-shield-alt verification-icon"></i>
                            <p class="mb-4">Un code de vérification à 6 chiffres a été envoyé à votre adresse email. Veuillez l'entrer ci-dessous pour continuer.</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('two-factor.verify') }}">
                            @csrf

                            <div class="mb-4 mx-auto" style="max-width: 200px;">
                                <input id="code" type="text" class="form-control form-control-md text-center @error('code') is-invalid @enderror" name="code" required autocomplete="one-time-code" autofocus placeholder="• • • • • •" maxlength="6">

                                @error('code')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <i class="fas fa-exclamation-circle me-1"></i> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-4 mx-auto" style="max-width: 200px;">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-lock me-2"></i> Vérifier
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center resend-container">
                            <p class="text-muted mb-2">Vous n'avez pas reçu le code?</p>
                            <form method="POST" action="{{ route('two-factor.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-paper-plane me-1"></i> Renvoyer le code
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4 text-muted">
                    <small>&copy; {{ date('Y') }} Fonds Tinga. Tous droits réservés.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format input to show only numbers and add spaces
        document.getElementById('code').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);
        });
    </script>
</body>
</html>