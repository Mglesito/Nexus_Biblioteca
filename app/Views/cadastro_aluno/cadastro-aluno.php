<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de aluno — SBE</title>
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
        <?= anchor('/bibliotecario/cadastro_aluno', 'Alunos', ['class' => 'active']) ?>
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
        <h1>Cadastro de aluno</h1>
        <p>Cadastre os dados dos leitores da biblioteca.</p>
      </div>
    </div>
    <div class="panel">
      <h2>Novo aluno</h2>
      <form method="post" action="<?= site_url('bibliotecario/cadastro_aluno/salvar') ?>">
      <?= csrf_field() ?>
      <div class="form-grid">
        <div class="field full"><label>Nome</label><input placeholder="Nome completo" name="nome"></div>
        <div class="field"><label>CPF</label><input placeholder="000.000.000-00" name="cpf"></div>
        <div class="field"><label>Ano</label><input placeholder="Ex.: 3º" name="ano"></div>
        <div class="field"><label>Turma</label><input placeholder="Ex.: 3ºD" name="turma"></div>
        <div class="field"><label>Curso</label><input placeholder="Curso técnico" name="curso"></div>
        <div class="field"><label>Endereço</label><input placeholder="Endereço completo" name="endereco"></div>
        <div class="field"><label>Bairro</label><input placeholder="Bairro" name="bairro"></div>
        <div class="field"><label>Contato</label><input placeholder="Telefone / WhatsApp" name="contato"></div>
        <div class="field"><label>Senha</label><input type="password" placeholder="Senha de acesso" name="senha"></div>
        <div class="field"><label>E-mail</label><input type="email" placeholder="aluno@email.com" name="email"></div>
        <input type="hidden" value="1" name="tipo_usuario">
      </div>
      <button class="btn-primary small" type="submit">Cadastrar aluno</button>
      </form>
    </div>
    <div class="section-row">
      <h2>Alunos cadastrados</h2>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ano</th>
            <th>Turma</th>
            <th>Curso</th>
            <th>Contato</th>
          </tr>
        </thead>
        <?php if (!empty($Aluno)): ?>

            <?php foreach ($Aluno as $A): ?>

              <tr>
                <td><?= esc($A['nome']) ?></td>
                <td><?= esc($A['cpf']) ?></td>
                <td><?= esc($A['ano']) ?></td>
                <td><?= esc($A['turma']) ?></td>
                <td><?= esc($A['curso']) ?></td>
                <td><?= esc($A['contato']) ?></td>
              </tr>

            <?php endforeach; ?>

          <?php else: ?>

            <tr>
              <td colspan="2" style="text-align:center;color:var(--ink-soft)">
                Nenhum aluno cadastrado.
              </td>
            </tr>

          <?php endif; ?>

        </tbody>
      </table>
    </div>
  </main>
</body>

</html>