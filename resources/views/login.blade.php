<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Page de connexion avec bulles</title>
<style>
/* Colle ici le CSS combiné complet que je t’ai donné */
body, html {
  margin: 0;
  padding: 0;
  scroll-behavior: smooth;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f4f6f9;
  overflow-x: hidden;
  height: 100vh;
  position: relative;
}

.login-card {
  width: 100%;
  max-width: 400px;
  background: white;
  border-radius: 12px;
  position: relative;
  z-index: 2;
  margin: auto;
  top: 50%;
  transform: translateY(-50%);
  padding: 30px;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
}

.bubbles-background {
  position: fixed;
  width: 100%;
  height: 100%;
  background: linear-gradient(to top left, #001f4d, #005792);
  overflow: hidden;
  z-index: 1;
  top: 0;
  left: 0;
}

.bubble {
  position: absolute;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  animation: float 10s infinite ease-in-out;
}

.bubble1 {
  width: 120px;
  height: 120px;
  top: 20%;
  left: 10%;
  animation-delay: 0s;
}

.bubble2 {
  width: 80px;
  height: 80px;
  bottom: 15%;
  right: 20%;
  animation-delay: 2s;
}

.bubble3 {
  width: 100px;
  height: 100px;
  top: 60%;
  left: 60%;
  animation-delay: 4s;
}

@keyframes float {
  0% {
    transform: translateY(0) scale(1);
  }
  50% {
    transform: translateY(-30px) scale(1.05);
  }
  100% {
    transform: translateY(0) scale(1);
  }
}
</style>
</head>
<body>

<div class="bubbles-background">
  <div class="bubble bubble1"></div>
  <div class="bubble bubble2"></div>
  <div class="bubble bubble3"></div>
</div>

<div class="login-card">
  <h2>Connexion</h2>
  <form>
    <label for="email">Email</label><br/>
    <input type="email" id="email" name="email" placeholder="Votre email" required style="width:100%; padding:10px; margin:10px 0; border-radius:6px; border:1px solid #ccc;" /><br/>
    <label for="password">Mot de passe</label><br/>
    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required style="width:100%; padding:10px; margin:10px 0; border-radius:6px; border:1px solid #ccc;" /><br/>
    <button type="submit" style="width:100%; padding:12px; border:none; border-radius:6px; background:#001f4d; color:white; font-weight:bold; cursor:pointer;">Se connecter</button>
  </form>
</div>

</body>
</html>
