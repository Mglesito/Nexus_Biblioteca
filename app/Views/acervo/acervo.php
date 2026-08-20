<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acervo — SBE</title>
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
        <?= anchor('/bibliotecario/acervo', 'Acervo', ['class' => 'active']) ?>
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
        <h1>Acervo</h1>
        <p>Todos os livros cadastrados na biblioteca.</p>
      </div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Registro</th>
            <th>Autor</th>
            <th>Título</th>
            <th>Exemplar</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <?php if (!empty($Acervo)): ?>

            <?php foreach ($Acervo as $Livro): ?>
              <?php if ($Livro['emprestado'] == false): ?>
                <tr>
                    <td><?= esc($Livro['registro']) ?></td>
                    <td><?= esc($Livro['autor']) ?></td>
                    <td><?= esc($Livro['titulo']) ?></td>
                    <td><?= esc($Livro['exemplar']) ?></td>
                    <td><?= esc($Livro['status']) ?></td>
                    <td>
                      <a href="<?= site_url('bibliotecario/emprestimos?registro=' . esc($Livro['registro'])) ?>" class="tbl-btn">
                        Emprestar
                      </a>
                    </td>
                </tr>
              <?php endif; ?>
              
            <?php endforeach; ?>

          <?php else: ?>

            <tr>
              <td colspan="6" style="text-align:center;color:var(--ink-soft)">
                Nenhum Livro cadastrado.
              </td>
            </tr>

          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>