<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de livro — SBE</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap"
    rel="stylesheet">
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
        <?= anchor('/bibliotecario/dashboard', 'Dashboard') ?>
        <?= anchor('/bibliotecario/acervo', 'Acervo') ?>
        <?= anchor('/bibliotecario/tombo', 'Tombos') ?>
        <?= anchor('/bibliotecario/cadastro_aluno', 'Alunos') ?>
        <?= anchor('/bibliotecario/livros', 'Livros', ['class' => 'active']) ?>
        <?= anchor('/bibliotecario/emprestimos', 'Empréstimos') ?>
        <?= anchor('/bibliotecario/', 'Remover') ?>
        <?= anchor('/bibliotecario/leitores', 'Leitores') ?>
        <?= anchor('/bibliotecario/historico', 'Histórico') ?>
      </nav>

      <div class="user-chip">
        <span class="role-badge">Bibliotecário</span>
        <span>Setor de Biblioteca</span>
        <a href="login-aluno.html" class="tbl-btn">Sair</a>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="page-head">
      <div>
        <h1>Cadastro de livro</h1>
        <p>Cadastre livros individualmente no sistema.</p>
      </div>
    </div>
    <div class="panel">
      <h2>Novo livro</h2>
      <form method="post" action="<?= site_url('bibliotecario/livros/salvar') ?>">
      <?= csrf_field() ?>
      <div class="form-grid">

        <div class="field">
          <label>Registro</label>
          <input placeholder="Ex.: L-2026-001" name="registro">
        </div>

        <div class="field">
          <label>Exemplar</label>
          <input type="number" placeholder="Ex.: 1" min="1" name="exemplar">
        </div>

        <div class="field">
          <label>Autor</label>
          <input placeholder="Nome do autor" name="autor">
        </div>

        <div class="field full">
          <label>Título</label>
          <input placeholder="Título do livro" name="titulo">
        </div>

        <div class="field full">
          <label>Status / Estado do livro</label>
          <select name="status">
            <option>Disponível — bom estado</option>
            <option>Disponível — estado regular</option>
            <option>Disponível — danificado</option>
            <option>Em manutenção</option>
            <option>Indisponível</option>
          </select>
        </div>

      </div>
      <button class="btn-primary small" type="submit">Cadastrar livro</button>
      </form>
    </div>
  </main>
</body>

</html>