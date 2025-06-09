{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion</title>
  <link rel="stylesheet" href="{{ asset('login.css') }}" />
</head>
<body>
  <div class="bubbles-background">
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
  </div>

  <div class="login-card">
    <h2>Connexion</h2>

    @if(session('status'))
      <div style="color: green;">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div style="color: red;">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
      @csrf
      <label for="email">Email</label><br/>
      <input type="email" name="email" id="email" placeholder="Votre email" required style="width:100%; padding:10px; margin:10px 0; border-radius:6px; border:1px solid #ccc;"  /><br/>

      <label for="password">Mot de passe</label><br/>
      <input type="password" name="password" id="password" placeholder="Votre mot de passe" required style="width:100%; padding:10px; margin:10px 0; border-radius:6px; border:1px solid #ccc;" /><br/>

      <button type="submit" style="width:100%; padding:12px; border:none; border-radius:6px; background:#001f4d; color:white; font-weight:bold; cursor:pointer;">Se connecter</button>
    </form>

    
  </div>
</body>
</html>
