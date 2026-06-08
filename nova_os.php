<?php 
require_once 'config/database.php';

// Busca dados para preencher os campos de seleção
$produtos = $pdo->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll(PDO::FETCH_ASSOC);
$responsaveis = $pdo->query("SELECT * FROM responsaveis")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Ordem de Serviço</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; }
        .container { max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Nova Ordem de Serviço</h2>
    <form action="salvar_os.php" method="POST">
        
        <h3>Dados do Cliente</h3>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Endereço:</label>
            <input type="text" name="endereco">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>
        <div class="form-group">
            <label>Celular:</label>
            <input type="text" name="celular">
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <label>Contato (Pessoa de Recado):</label>
            <input type="text" name="contato">
        </div>

        <hr>
        <h3>Dados do Atendimento</h3>
        
        <div class="form-group">
            <label>Produto:</label>
            <select name="produto_id" required>
                <option value="">Selecione o Produto</option>
                <?php foreach($produtos as $p): ?>
                    <option value="<?=$p['id']?>"><?=$p['nome_produto']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Serviço a ser realizado:</label>
            <select name="servico_id" required>
                <option value="">Selecione o Serviço</option>
                <?php foreach($servicos as $s): ?>
                    <option value="<?=$s['id']?>"><?=$s['descricao_servico']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Responsável pelo Serviço:</label>
            <select name="responsavel_id" required>
                <option value="">Selecione o Responsável</option>
                <?php foreach($responsaveis as $r): ?>
                    <option value="<?=$r['id']?>"><?=$r['nome_responsavel']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Data de Emissão:</label>
            <input type="date" name="data_emissao" value="<?=date('Y-m-d')?>" required>
        </div>
        <div class="form-group">
            <label>Data de Entrada do Produto:</label>
            <input type="date" name="data_entrada" required>
        </div>
        <div class="form-group">
            <label>Data de Saída do Produto (Previsão/Fim):</label>
            <input type="date" name="data_saida">
        </div>

        <button type="submit">Gravar Ordem de Serviço</button>
    </form>
</div>

</body>
</html>
