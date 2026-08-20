<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard do aluno — SBE</title>
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
        <div class="seal"><img src="<?= base_url('walter.jpg') ?>" alt="Logo da escola"></div>
        <div>
          <div class="school">Escola Estadual De Educação Profissional Walter Ramos de Araújo</div>
          <div class="sys">SBE · Sistema de Biblioteca Escolar</div>
        </div>
      </div>

      <nav class="nav">
        <?= anchor('/aluno/dashboard', 'Dashboard', ['class' => 'active']) ?>
        <?= anchor('/aluno/catalogo', 'Catalogo') ?>
        <?= anchor('/aluno/emprestimo', 'Emprestimo') ?>
      </nav>

      <div class="user-chip">
        <span class="role-badge">Aluno</span>
        <span>—</span>
        <?= anchor('/login/deslogar', 'Sair', ['class' => 'tbl-btn']) ?>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="page-head">
      <div>
        <h1>Dashboard do aluno</h1>
        <p>Acompanhe sua situação na biblioteca.</p>
      </div>
    </div>
    <div class="stats-grid">
      <div class="stat-card">
        <div class="num"><?= esc($totalLivros) ?></div>
        <div class="lab">Livros no acervo</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= esc($livrosDisponiveis) ?></div>
        <div class="lab">Disponíveis</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= esc(count($emprestimosAtivos)) ?></div>
        <div class="lab">Meu empréstimo</div>
      </div>
      <div class="stat-card alert">
        <div class="num"><?= esc($emprestimosEmAtraso) ?></div>
        <div class="lab">Em atraso</div>
      </div>
    </div>
    <div class="notice"><span>🛈</span><span>Cada aluno pode possuir apenas <b>1 livro emprestado por vez.</b></span>
    </div>
    <div class="panel">
      <h2>Informações do aluno</h2>
      <?php if (!empty($aluno)): ?>
        <p><b>Nome:</b> <?= esc($aluno['nome']) ?></p>
        <p><b>Turma:</b> <?= esc($aluno['turma']) ?> &nbsp; <b>Curso:</b> <?= esc($aluno['curso']) ?></p>
      <?php else: ?>
        <p>Dados cadastrais não encontrados.</p>
      <?php endif; ?>

      <?php if (!empty($emprestimosAtivos)): ?>
        <h3>Empréstimo atual</h3>
        <p><b>Livro:</b> <?= esc($emprestimosAtivos[0]['titulo'] ?? $emprestimosAtivos[0]['registro']) ?></p>
        <p><b>Devolução prevista:</b> <?= esc(date('d/m/Y', strtotime($emprestimosAtivos[0]['data_devolucao']))) ?></p>
      <?php else: ?>
        <p>Você não possui empréstimo ativo.</p>
      <?php endif; ?>
    </div>
  </main>
</body>

</html>