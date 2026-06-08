CREATE DATABASE IF NOT EXISTS sistema_os;
USE sistema_os;

-- 1. Tabela de Clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    celular VARCHAR(20),
    email VARCHAR(100),
    contato VARCHAR(100)
);

-- 2. Tabela de Produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100) NOT NULL -- Ex: Cadeira Giratória
);

-- 3. Tabela de Serviços
CREATE TABLE servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao_servico VARCHAR(255) NOT NULL -- Ex: Troca da coluna de regulagem
);

-- 4. Tabela de Responsáveis
CREATE TABLE responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_responsavel VARCHAR(100) NOT NULL
);

-- 5. Tabela de Ordem de Serviço (Une todas as informações)
CREATE TABLE ordens_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    produto_id INT,
    servico_id INT,
    responsavel_id INT,
    data_emissao DATE NOT NULL,
    data_entrada DATE NOT NULL,
    data_saida DATE,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id),
    FOREIGN KEY (responsavel_id) REFERENCES responsaveis(id)
);

-- Inserindo dados de teste para os selects do formulário
INSERT INTO produtos (nome_produto) VALUES ('Cadeira Giratória'), ('Mesa de Escritório');
INSERT INTO servicos (descricao_servico) VALUES ('Troca da coluna de regulagem de altura'), ('Estofamento de assento');
INSERT INTO responsaveis (nome_responsavel) VALUES ('Técnico João Silva'), ('Técnica Maria Souza');
