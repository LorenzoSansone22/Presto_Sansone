<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richiesta Revisore</title>
</head>
<body>
    <div style="font-family: sans-serif; padding: 20px;">
        <h1>Un utente ha richiesto di diventare revisore</h1>
        <h2>Ecco i suoi dati:</h2>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        
        <div style="margin-top: 30px;">
            <p>Se vuoi rendere questo utente revisore, clicca sul pulsante qui sotto:</p>
            <a href="{{ route('make.revisor', compact('user')) }}" 
               style="background-color: #ffc107; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Rendi Revisore
            </a>
        </div>
    </div>
</body>
</html>