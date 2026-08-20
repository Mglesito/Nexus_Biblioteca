<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leitores — SBE</title>
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
        <?= anchor('/bibliotecario/dashboard', 'Dashboard') ?>
        <?= anchor('/bibliotecario/acervo', 'Acervo') ?>
        <?= anchor('/bibliotecario/tombo', 'Tombos') ?>
        <?= anchor('/bibliotecario/cadastro_aluno', 'Alunos') ?>
        <?= anchor('/bibliotecario/livros', 'Livros') ?>
        <?= anchor('/bibliotecario/emprestimos', 'Empréstimos') ?>
        <?= anchor('/bibliotecario/leitores', 'Leitores', ['class' => 'active']) ?>
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
        <h1>Leitores</h1>
        <p>Situação dos alunos cadastrados.</p>
      </div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Turma</th>
            <th>Curso</th>
            <th>Situação</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($leitores)): ?>
            <?php foreach ($leitores as $leitor): ?>
              <tr>
                <td><?= esc($leitor['cpf']) ?></td>
                <td><?= esc($leitor['nome']) ?></td>
                <td><?= esc($leitor['turma']) ?></td>
                <td><?= esc($leitor['curso']) ?></td>
                <td><?= $leitor['emprestimos_ativos'] ?> empréstimo<?= $leitor['emprestimos_ativos'] != 1 ? 's' : '' ?> ativo<?= $leitor['emprestimos_ativos'] != 1 ? 's' : '' ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center;color:var(--ink-soft)">Nenhum leitor com empréstimos ativos.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>