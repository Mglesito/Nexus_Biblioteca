<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico — SBE</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
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
        <?= anchor('/bibliotecario/leitores', 'Leitores') ?>
        <?= anchor('/bibliotecario/historico', 'Histórico', ['class' => 'active']) ?>
</nav>

    <div class="user-chip">
      <span class="role-badge">Bibliotecário</span>
      <span>Setor de Biblioteca</span>
      <?= anchor('/login/deslogar', 'Sair', ['class' => 'tbl-btn']) ?>
    </div>
  </div>
</header>
<main class="main">
<div class="page-head"><div><h1>Histórico</h1><p>Registro das movimentações realizadas no sistema.</p></div></div>
<div class="table-wrap"><table><thead><tr><th>Data/Hora</th><th>Ação</th><th>Aluno</th><th>Livro</th><th>Descrição</th></tr></thead>
<tbody>
<?php if (!empty($historico)): ?>
  <?php foreach ($historico as $registro): ?>
    <tr>
      <td><?= esc($registro['data_hora']) ?></td>
      <td>
        <?php if ($registro['acao'] === 'EMPRESTIMO'): ?>
          <span style="background-color: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">EMPRÉSTIMO</span>
        <?php elseif ($registro['acao'] === 'DEVOLUCAO'): ?>
          <span style="background-color: #e3f2fd; color: #1565c0; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">DEVOLUÇÃO</span>
        <?php elseif ($registro['acao'] === 'CADASTRO_ALUNO'): ?>
          <span style="background-color: #f3e5f5; color: #6a1b9a; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">CADASTRO ALUNO</span>
        <?php elseif ($registro['acao'] === 'RENOVACAO'): ?>
          <span style="background-color: #fff3e0; color: #e65100; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">RENOVAÇÃO</span>
        <?php elseif ($registro['acao'] === 'CADASTRO_TOMBO'): ?>
          <span style="background-color: #f1f8e9; color: #558b2f; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">CADASTRO TOMBO</span>
        <?php elseif ($registro['acao'] === 'EDICAO_TOMBO'): ?>
          <span style="background-color: #fce4ec; color: #c2185b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">EDIÇÃO TOMBO</span>
        <?php elseif ($registro['acao'] === 'EXCLUSAO_TOMBO'): ?>
          <span style="background-color: #ffebee; color: #b71c1c; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">EXCLUSÃO TOMBO</span>
        <?php else: ?>
          <span><?= esc($registro['acao']) ?></span>
        <?php endif; ?>
      </td>
      <td><?= esc($registro['nome_aluno'] ?? '-') ?></td>
      <td><?= esc($registro['titulo_livro'] ?? '-') ?></td>
      <td><?= esc($registro['descricao'] ?? '-') ?></td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr><td colspan="5" style="text-align:center;color:var(--ink-soft)">Nenhuma movimentação registrada.</td></tr>
<?php endif; ?>
</tbody></table></div>
</main>
</body>
</html>
