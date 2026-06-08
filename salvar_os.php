<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        // 1. Inserir Cliente
        $stmtCliente = $pdo->prepare("INSERT INTO clientes (nome, endereco, telefone, celular, email, contato) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtCliente->execute([
            $_POST['nome'],
            $_POST['endereco'],
            $_POST['telefone'],
            $_POST['celular'],
            $_POST['email'],
            $_POST['contato']
        ]);
        
        // Pega o ID do cliente que acabou de ser inserido
        $cliente_id = $pdo->lastInsertId();

        // 2. Inserir a Ordem de Serviço
        $stmtOS = $pdo->prepare("INSERT INTO ordens_servico (cliente_id, produto_id, servico_id, responsavel_id, data_emissao, data_entrada, data_saida) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Trata data de saída se estiver vazia
        $data_saida = !empty($_POST['data_saida']) ? $_POST['data_saida'] : null;

        $stmtOS->execute([
            $cliente_id,
            $_POST['produto_id'],
            $_POST['servico_id'],
            $_POST['responsavel_id'],
            $_POST['data_emissao'],
            $_POST['data_entrada'],
            $data_saida
        ]);

        $pdo->commit();
        echo "<script>alert('OS gravada com sucesso!'); window.location.href='index.php';</script>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao salvar a ordem de serviço: " . $e->getMessage();
    }
}
?>
