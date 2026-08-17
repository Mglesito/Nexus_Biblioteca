<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Livro de Tombo — SBE</title>
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
        <?= anchor('/bibliotecario/tombo', 'Tombos', ['class' => 'active']) ?>
        <?= anchor('/bibliotecario/cadastro_aluno', 'Alunos') ?>
        <?= anchor('/bibliotecario/livros', 'Livros') ?>
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
        <h1>Livro de Tombo</h1>
        <p>Registro patrimonial e bibliográfico dos exemplares.</p>
      </div>
    </div>
    <div class="tombo-info">Preencha todos os dados necessários para registrar um novo tombo. Cada registro poderá ser
      editado posteriormente.</div>
    <div class="panel">
      <h2>Novo tombo</h2>
      <form method="post" action="<?= site_url('bibliotecario/tombo/salvar') ?>">
        <?= csrf_field() ?>
        <div class="form-grid three">
          <div class="field"><label>Registro</label><input type="number" name="registro" placeholder="Ex.: T-2026-0013"
              required></div>
          <div class="field"><label>Data de entrada</label><input name="data_entrada" type="date"></div>
          <div class="field"><label>Autor</label><input name="autor" placeholder="Nome do autor"></div>
          <div class="field"><label>Título</label><input name="titulo" placeholder="Título da obra" required></div>
          <div class="field"><label>Volume</label><input name="volume" placeholder="Ex.: 1"></div>
          <div class="field"><label>Exemplar</label><input name="exemplar" placeholder="Ex.: 01"></div>
          <div class="field"><label>Edição</label><input name="edicao" placeholder="Ex.: 2ª edição"></div>
          <div class="field"><label>Ano</label><input name="ano" placeholder="Ex.: 2025"></div>
          <div class="field"><label>Local</label><input name="local" placeholder="Ex.: Fortaleza"></div>
          <div class="field"><label>Tipo de aquisição</label><select name="tipo_aquisicao">
              <option value="">Selecione</option>
              <option>Compra</option>
              <option>Doação</option>
              <option>Permuta</option>
              <option>Transferência</option>
              <option>Outro</option>
            </select></div>
          <div class="field"><label>Código de gênero</label><input name="codigo_genero" placeholder="Ex.: ROM"></div>
        </div>
        <button class="btn-primary small" type="submit">Registrar tombo</button>
      </form>
    </div>
    <div class="section-row">
      <h2>Tabela de Tombos</h2>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Registro</th>
            <th>Entrada</th>
            <th>Autor</th>
            <th>Título</th>
            <th>Vol.</th>
            <th>Ex.</th>
            <th>Edição</th>
            <th>Ano</th>
            <th>Local</th>
            <th>Aquisição</th>
            <th>Gênero</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($Tombo)): ?>
            <tr>
              <td colspan="12" style="text-align:center;color:var(--ink-soft)">Nenhum tombo cadastrado.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($Tombo as $t): ?>
              <tr>
                <td><?= esc($t['registro']) ?></td>
                <td><?= esc($t['data_entrada']) ?></td>
                <td><?= esc($t['autor']) ?></td>
                <td><?= esc($t['titulo']) ?></td>
                <td><?= esc($t['volume']) ?></td>
                <td><?= esc($t['exemplar']) ?></td>
                <td><?= esc($t['edicao']) ?></td>
                <td><?= esc($t['ano']) ?></td>
                <td><?= esc($t['local']) ?></td>
                <td><?= esc($t['tipo_aquisicao']) ?></td>
                <td><?= esc($t['codigo_genero']) ?></td>
                <td>
                  <a class="tbl-btn" href="<?= site_url('bibliotecario/tombo/editar/' . $t['registro']) ?>">Editar</a>
                  <a class="tbl-btn" href="<?= site_url('bibliotecario/tombo/excluir/' . $t['registro']) ?>"
                    onclick="return confirm('Excluir este tombo?')">Excluir</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>