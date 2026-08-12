<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo — SBE</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
  
</head>
<body>
<div class="ribbon"><span class="g"></span><span class="y"></span><span class="w"></span></div>

<header class="app-header">
  <div class="header-top">Governo do Estado do Ceará · Secretaria da Educação</div>
  <div class="header-main">
    <div class="header-brand">
      <div class="seal"><img src="walter.jpeg" alt="Logo da escola"></div>
      <div>
        <div class="school">Escola Estadual De Educação Profissional Walter Ramos de Araújo</div>
        <div class="sys">SBE · Sistema de Biblioteca Escolar</div>
      </div>
    </div>
    
<nav class="nav">
  <?= anchor('/aluno/dashboard','Dashboard')?>
  <?= anchor('/aluno/catalogo','Catalogo',['class' => 'active'])?>
  <?= anchor('/aluno/emprestimo','Emprestimo')?>
</nav>

    <div class="user-chip">
      <span class="role-badge">Aluno</span>
      <span>—</span>
      <?= anchor('/login/deslogar', 'Sair', ['class' => 'tbl-btn']) ?>
    </div>
  </div>
</header>
<main class="main">
<div class="page-head"><div><h1>Catálogo</h1><p>Consulte os títulos disponíveis no acervo.</p></div></div>
<div class="search-row"><input type="search" placeholder="Buscar por título, autor ou registro..."></div>
<div class="chips">
  <span class="chip active">Todos</span>
</div>
<div class="empty-state">
  <h3>Nenhum título cadastrado</h3>
  <p>O catálogo será preenchido quando os livros forem cadastrados no banco de dados.</p>
</div>
</main>
</body>
</html>
