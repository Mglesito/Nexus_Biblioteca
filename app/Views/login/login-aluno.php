<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
  
</head>
<body>
<div class="ribbon"><span class="g"></span><span class="y"></span><span class="w"></span></div>

<div id="login-screen">
  
<div class="letterhead">
  <div class="seal">
    <img src="walter.jpeg" alt="Logo da escola">
  </div>
  <div class="org">Governo do Estado do Ceará · Secretaria da Educação</div>
  <div class="school">Escola Estadual De Educação Profissional Walter Ramos de Araújo</div>
</div>

  <div class="login-card">
    <div class="login-body">
      <h1 class="login-title">Acesso ao sistema</h1>
      <p class="login-sub">Entre com seu CPF para ter acesso e senha.</p>
      <?= form_open('login/verificar_usuario') ?>
        <div class="field">
          <label for="login-user">CPF</label>
          <input id="login-user" name="cpf" type="number" placeholder="000.000.000-00" autocomplete="username" required>
        </div>
        <div class="field">
          <label for="login-pass">Senha</label>
          <input id="login-pass" name="senha" type="password" placeholder="••••••••" autocomplete="current-password" required>
        </div>
        <button type="submit" class="btn-primary">Entrar</button>
      <?= form_close()?>
    </div>
  </div>
</div>
  <?php if (session()->getFlashdata('error')) : ?>
      <script>
          alert("<?= esc(session()->getFlashdata('error')) ?>");
      </script>
  <?php endif; ?>

</body>
</html>
