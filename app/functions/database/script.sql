DROP DATABASE amazoniapneus;
CREATE DATABASE amazoniapneus;
USE amazoniapneus;





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
    fone BIGINT(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    datanasc DATE NOT NULL,
    ncasa INTEGER(5) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    complemento VARCHAR(255),
    tipo VARCHAR(1) NOT NULL DEFAULT "c" CHECK (tipo IN ('c', 'a')),
    ativo VARCHAR(1) NOT NULL DEFAULT "s" CHECK (ativo IN ('s', 'n')),
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


-- inserts --


INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (1, 'PR', 'Cascavel');
    
INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (2, 'PR', 'Toledo');
    


INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (3, 'SC', 'Joinville');



INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (1, 'Célia', 'Rua Parana', '12345678901', '987654321', 'celia_me_da_nota_plz@gmail.com', MD5('senha123'), '1990-01-01', '123', 'Centro', 'Casa portão preto', 'c', 's', 1);
    
    
    INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES
    (2, 'Matheus', 'Rua dos Tropeiros', '98765432101', '123456789', 'melhor_mortis_do_brasil@gmail.com', MD5('admin123'), '1985-01-01',  '456', 'Tropical', 'Casa Esquina', 'a', 's', 2);
    
    
   INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (3, 'Elliot', 'Rua Pernambuco', '99945678881', '131554321', 'fsociety@gmail.com', MD5('mrrobot'), '1998-10-28', '158', 'Centro', 'apartamento cinza', 'c', 's', 3);




INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES 

    ('bridgestone', 'pneu novo da briegstone', 'c', '200,00' );
    
    
INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES     
    ('nuncafura', 'pneu recapado pela empresa', 'r', '230,00' );
    
    
    
    INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES 
    ('goodyear', 'pneu da melhor recapagem', 'o', '500,00' );