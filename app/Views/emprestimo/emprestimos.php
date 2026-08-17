<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Empréstimos — SBE</title>
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
        <?= anchor('/bibliotecario/livros', 'Livros') ?>
        <?= anchor('/bibliotecario/emprestimos', 'Empréstimos', ['class' => 'active']) ?>
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
        <h1>Cadastro de empréstimo</h1>
        <p>Registre a retirada de livros pelos alunos.</p>
      </div>
    </div>
    <div class="panel">
      <h2>Novo empréstimo</h2>
      <div class="form-grid">
        <div class="field"><label>Aluno</label><select>
            <input type="text">
          </select></div>
        <div class="field full"><label>Livro</label><select>
            <input type="number">
          </select></div>
      </div>
      <p class="form-note">Selecione um aluno sem empréstimo ativo e um livro disponível.</p>
      <button class="btn-primary small" type="submit">Registrar empréstimo</button>
    </div>
    <div class="section-row">
      <h2>Empréstimos ativos</h2>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Data</th>
            <th>Aluno</th>
            <th>Turma</th>
            <th>Livro</th>
            <th>Devolução</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="7" style="text-align:center;color:var(--ink-soft)">Nenhum empréstimo ativo.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>