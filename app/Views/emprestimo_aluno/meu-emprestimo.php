<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu empréstimo — SBE</title>
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
        <?= anchor('/aluno/dashboard', 'Dashboard') ?>
        <?= anchor('/aluno/catalogo', 'Catalogo') ?>
        <?= anchor('/aluno/emprestimo', 'Emprestimo', ['class' => 'active']) ?>
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
        <h1>Meu empréstimo</h1>
        <p>Situação da sua retirada atual.</p>
      </div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Livro</th>
            <th>Registro</th>
            <th>Empréstimo</th>
            <th>Devolução</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($emprestimos)): ?>
            <?php foreach ($emprestimos as $emprestimo): ?>
              <?php $atrasado = (int) $emprestimo['devolvido'] === 0 && $emprestimo['data_devolucao'] < date('Y-m-d'); ?>
              <tr>
                <td><?= esc($emprestimo['titulo'] ?? 'Livro não encontrado') ?></td>
                <td><?= esc($emprestimo['registro']) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($emprestimo['data_emprestimo']))) ?></td>
                <td><?= esc(date('d/m/Y', strtotime($emprestimo['data_devolucao']))) ?></td>
                <td>
                  <?php if ((int) $emprestimo['devolvido'] === 1): ?>
                    <span class="badge green">Devolvido</span>
                  <?php elseif ($atrasado): ?>
                    <span class="badge red">Em atraso</span>
                  <?php else: ?>
                    <span class="badge yellow">Em aberto</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" style="text-align:center;color:var(--ink-soft)">Você ainda não possui empréstimos.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>