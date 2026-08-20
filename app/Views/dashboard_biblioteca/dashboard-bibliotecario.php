<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard do bibliotecário — SBE</title>
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
        <?= anchor('/bibliotecario/dashboard', 'Dashboard', ['class' => 'active']) ?>
        <?= anchor('/bibliotecario/acervo', 'Acervo') ?>
        <?= anchor('/bibliotecario/tombo', 'Tombos') ?>
        <?= anchor('/bibliotecario/cadastro_aluno', 'Alunos') ?>
        <?= anchor('/bibliotecario/livros', 'Livros') ?>
        <?= anchor('/bibliotecario/emprestimos', 'Empréstimos') ?>
        <?= anchor('/bibliotecario/leitores', 'Leitores') ?>
        <?= anchor('/bibliotecario/historico', 'Histórico') ?>
      </nav>

      <div class="user-chip">
        <span class="role-badge">Bibliotecário</span>
        <span>Setor de Biblioteca</span>
        <?= anchor('/login/deslogar', 'Sair', ['class' => 'tbl-btn']) ?>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="page-head">
      <div>
        <h1>Dashboard do bibliotecário</h1>
        <p>Visão geral do funcionamento da biblioteca.</p>
      </div>
    </div>
    <div class="stats-grid">
      <div class="stat-card">
        <div class="num"><?= $totalLivros ?? 0 ?></div>
        <div class="lab">Livros cadastrados</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= $livrosDisponiveis ?? 0 ?></div>
        <div class="lab">Disponíveis</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= $livrosEmprestados ?? 0 ?></div>
        <div class="lab">Emprestados</div>
      </div>
      <div class="stat-card">
        <div class="num"><?= $totalAlunos ?? 0 ?></div>
        <div class="lab">Alunos cadastrados</div>
      </div>
      <div class="stat-card alert">
        <div class="num"><?= $alunosEmAtraso ?? 0 ?></div>
        <div class="lab">Em atraso</div>
      </div>
    </div>
    <div class="section-row">
      <h2>Empréstimos em atraso</h2>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Aluno</th>
            <th>Turma</th>
            <th>Livro</th>
            <th>Devolução</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($emprestimosEmAtraso)): ?>
            <?php foreach ($emprestimosEmAtraso as $atraso): ?>
              <tr>
                <td><?= esc($atraso['nome_aluno'] ?? 'Aluno não encontrado') ?></td>
                <td><?= esc($atraso['turma'] ?? '-') ?></td>
                <td><?= esc($atraso['titulo'] ?? 'Livro não encontrado') ?></td>
                <td><?= esc($atraso['data_devolucao']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" style="text-align:center;color:var(--ink-soft)">Nenhum empréstimo em atraso.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>