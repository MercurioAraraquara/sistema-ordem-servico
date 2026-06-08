<?php
require_once 'config/database.php';

// Query robusta trazendo os nomes em vez de apenas os IDs numéricos (INNER JOIN)
$sql = "SELECT os.id, c.nome AS cliente, p.nome_produto AS produto, s.descricao_servico AS servico, r.nome_responsavel AS responsavel, os.data_emissao 
        FROM ordens_servico os
        INNER JOIN clientes c ON os.cliente_id = c.id
        INNER JOIN produtos p ON os.produto_id = p.id
        INNER JOIN servicos s ON os.servico_id = s.id
        INNER JOIN responsaveis r ON os.responsavel_id = r.id
        ORDER BY os.id DESC";

$lista = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de OS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .btn { background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

<h2>Painel de Ordens de Serviço</h2>
<a href="nova_os.php" class="btn">Nova Ordem de Serviço</a>

<table>
    <tr>
        <th>Nº OS</th>
        <th>Cliente</th>
        <th>Produto</th>
        <th>Serviço</th>
        <th>Responsável</th>
        <th>Emissão</th>
    </tr>
    <?php if(count($lista) > 0): ?>
        <?php foreach($lista as $os): ?>
        <tr>
            <td><?=$os['id']?></td>
            <td><?=$os['cliente']?></td>
            <td><?=$os['produto']?></td>
            <td><?=$os['servico']?></td>
            <td><?=$os['responsavel']?></td>
            <td><?=date('d/m/Y', strtotime($os['data_emissao']))?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Nenhuma ordem de serviço cadastrada.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
