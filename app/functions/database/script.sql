DROP DATABASE IF EXISTS amazoniabd;
CREATE DATABASE IF NOT EXISTS amazoniabd;
USE amazoniabd;


CREATE TABLE tb_cidades (
    codcidade INT PRIMARY KEY AUTO_INCREMENT,
    estado VARCHAR(2) NOT NULL CHECK (estado IN ('pr', 'sc', 'rs')),
    nome VARCHAR(50) NOT NULL
);


CREATE TABLE tb_clientes (
    codcliente INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    cpf BIGINT(11) ZEROFILL NOT NULL,
    fone VARCHAR(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    datanasc DATE NOT NULL,
    ncasa VARCHAR(5) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    complemento VARCHAR(255),
    tipo VARCHAR(1) NOT NULL DEFAULT "c" CHECK (tipo IN ('c', 'a')),
    ativo VARCHAR(1) NOT NULL CHECK (ativo IN ('s', 'n')),
    codcidade INTEGER,
    FOREIGN KEY (codcidade) REFERENCES tb_cidades (codcidade)
);

CREATE TABLE tb_medidas (
    codmedida INTEGER PRIMARY KEY AUTO_INCREMENT,
    largura INTEGER NOT NULL,
    aro INTEGER NOT NULL,
    medida INTEGER NOT NULL,
    altura INTEGER NOT NULL,
    indicecarga INTEGER NOT NULL,
    velocidade INTEGER NOT NULL,
    construcao VARCHAR(1) NOT NULL CHECK (construcao IN ('r', 'c')),
    raio INTEGER NOT NULL
);

CREATE TABLE tb_pneus (
    codpneu INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomepneu VARCHAR(150) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    tipo VARCHAR(1) NOT NULL CHECK (tipo IN ('c', 'r', 'o')),  /*verificar qual tipo ele é, se é caminhao(C), se é carreta(R), se é onibus (O) */
    preco FLOAT(5,2) NOT NULL,
    codmedida INTEGER,
    FOREIGN KEY (codmedida) REFERENCES tb_medidas (codmedida)
);



CREATE TABLE tb_compras (
    codcompra INTEGER PRIMARY KEY AUTO_INCREMENT,
    entregue BOOLEAN NOT NULL,
    entrega VARCHAR(150) NOT NULL,
    codentrega INTEGER NOT NULL,
    valorentrega FLOAT(5,2) NOT NULL,
    formapagamento INTEGER NOT NULL,
    dtcompra DATE NOT NULL,
    codcliente INTEGER,
    FOREIGN KEY (codcliente) REFERENCES tb_clientes (codcliente)
);

CREATE TABLE tb_compras_pneus (
    codcompra_pneu INTEGER PRIMARY KEY AUTO_INCREMENT,
    qntd INTEGER NOT NULL,
    preco FLOAT(5,2) NOT NULL,
    codcompra INTEGER,
    codpneu INTEGER,
    FOREIGN KEY (codcompra) REFERENCES tb_compras (codcompra),
    FOREIGN KEY (codpneu) REFERENCES tb_pneus (codpneu)
);


CREATE TABLE tb_imagens (
    codimg INT PRIMARY KEY AUTO_INCREMENT,
    url VARCHAR(255),
    nomeimg VARCHAR(150),
    codpneu INTEGER,
    FOREIGN KEY (codpneu) REFERENCES tb_pneus (codpneu)

);