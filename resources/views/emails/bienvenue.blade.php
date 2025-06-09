<h2>Bienvenue {{ $user->name }} !</h2>
<p>Votre compte a été créé avec succès.</p>
<p><strong>Email :</strong> {{ $user->email }}</p>
<p><strong>Mot de passe :</strong> {{ $password }}</p>
<p>Connectez-vous à la plateforme via <a href="{{ url('/login') }}">ce lien</a>.</p>

<p>Cordialement,<br>