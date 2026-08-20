<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo — SBE</title>
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
        <?= anchor('/aluno/catalogo', 'Catalogo', ['class' => 'active']) ?>
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
        <h1>Catálogo</h1>
        <p>Consulte os títulos disponíveis no acervo.</p>
      </div>
    </div>
    <div class="search-row"><input id="busca-catalogo" type="search" placeholder="Buscar por título, autor ou registro..." aria-label="Buscar no catálogo"></div>
    <div class="chips">
      <span class="chip active">Disponíveis</span>
    </div>
    <div class="table-wrap">
      <table id="tabela-catalogo">
        <thead>
          <tr>
            <th>Registro</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Exemplar</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($livros)): ?>
            <?php foreach ($livros as $livro): ?>
              <tr>
                <td><?= esc($livro['registro']) ?></td>
                <td><?= esc($livro['titulo']) ?></td>
                <td><?= esc($livro['autor']) ?></td>
                <td><?= esc($livro['exemplar']) ?></td>
                <td><?= esc($livro['status']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" style="text-align:center;color:var(--ink-soft)">Nenhum livro disponível.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <script>
      document.getElementById('busca-catalogo').addEventListener('input', function () {
        const termo = this.value.toLowerCase();
        document.querySelectorAll('#tabela-catalogo tbody tr').forEach(function (linha) {
          linha.hidden = !linha.textContent.toLowerCase().includes(termo);
        });
      });
    </script>
  </main>
</body>

</html>