<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .header {
            background-color: #117a1a;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Fonds Tinga - Vérification</h1>
        </div>
        <h2>Code de vérification</h2>
        <p>Bonjour,</p>
        <p>Votre code de vérification pour accéder à la plateforme Fonds Tinga est :</p>
        <div class="code">{{ $details['code'] }}</div>
        <p>Ce code expirera dans 10 minutes.</p>
        <p>Si vous n'avez pas demandé ce code, veuillez ignorer cet email et contacter l'administrateur.</p>
        <div class="footer">
            <p>© {{ date('Y') }} Fonds Tinga. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>