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
        <?= anchor('/bibliotecario/emprestimos', 'Empréstimos', ['class' => 'active']) ?>
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
        <h1>Cadastro de empréstimo</h1>
        <p>Registre a retirada de livros pelos alunos.</p>
      </div>
    </div>
    <?php if (session()->getFlashdata('erro')): ?>
      <div style="background-color: #fee; border: 1px solid #f99; border-radius: 4px; padding: 12px 16px; margin-bottom: 16px; color: #c33;">
        <strong>Erro:</strong> <?= esc(session()->getFlashdata('erro')) ?>
      </div>
    <?php endif; ?>
    <div class="panel">
      <h2>Novo empréstimo</h2>
      <form method="post" action="<?= site_url('bibliotecario/emprestimos/salvar') ?>">
        <?= csrf_field() ?>
        <div class="form-grid">
          <div class="field"><label>Aluno</label>
            <input type="text" name="cpf" id="cpf-input">
          </div>
          <div class="field"><label>Livro</label>
            <input type="text" name="registro" id="registro-input">
          </div>
        </div>
        <input type="hidden" value="0" name="devolvido">
        <input type="hidden" name="data_emprestimo" value="<?= date('Y-m-d') ?>">
        <p class="form-note">Selecione um aluno sem empréstimo ativo e um livro disponível.</p>
        <button class="btn-primary small" type="submit">Registrar empréstimo</button>
      </form>
    </div>
    <script>
      // Pré-carregar registro da URL se fornecido
      document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const registro = urlParams.get('registro');
        
        if (registro) {
          document.getElementById('registro-input').value = registro;
        }
      });
    </script>
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

          <?php if (!empty($Emprestimos)): ?>

            <?php foreach ($Emprestimos as $Emprestimo): ?>

              <tr>

                <td>
                  <?= esc($Emprestimo['data_emprestimo']) ?>
                </td>

                <td>
                  <?= esc($Emprestimo['nome_aluno'] ?? 'Aluno não encontrado') ?>
                </td>

                <td>
                  <?= esc($Emprestimo['turma'] ?? '-') ?>
                </td>

                <td>
                  <?= esc($Emprestimo['titulo'] ?? 'Livro não encontrado') ?>
                </td>

                <td>
                  <?= esc($Emprestimo['data_devolucao']) ?>
                </td>

                <td>
                  <?php if ($Emprestimo['devolvido'] == 0): ?>
                    <span style="background-color: #ffeaa7; color: #d63031; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Em aberto</span>
                  <?php else: ?>
                    <span style="background-color: #a9e64d; color: #27ae60; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Devolvido</span>
                  <?php endif; ?>
                </td>

                <td>
                  <?php if ($Emprestimo['devolvido'] == 0): ?>
                    <a href="<?= site_url('bibliotecario/emprestimos/devolver/' . $Emprestimo['id']) ?>" class="tbl-btn" style="background-color: #4caf50;">
                      Devolver
                    </a>
                    <a href="<?= site_url('bibliotecario/emprestimos/adicionarDias/' . $Emprestimo['id']) ?>" class="tbl-btn" style="background-color: #2196f3;">
                      +7 dias
                    </a>
                  <?php else: ?>
                    <span style="color: var(--ink-soft);">-</span>
                  <?php endif; ?>
                </td>

              </tr>

            <?php endforeach; ?>

          <?php else: ?>

            <tr>
              <td colspan="7" style="text-align:center;color:var(--ink-soft)">
                Nenhum empréstimo cadastrado.
              </td>
            </tr>

          <?php endif; ?>

        </tbody>
      </table>
    </div>
  </main>
</body>

</html>