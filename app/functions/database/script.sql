DROP DATABASE amazoniapneus;
CREATE DATABASE amazoniapneus;
USE amazoniapneus;





CREATE TABLE tb_cidades (
    codcidade INT PRIMARY KEY AUTO_INCREMENT,
    estado VARCHAR(2) NOT NULL CHECK (estado IN ('PR', 'SC', 'RS')),
    nome VARCHAR(50) NOT NULL
);


CREATE TABLE tb_clientes (
    codcliente INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    cpf BIGINT(11) ZEROFILL NOT NULL,
    fone BIGINT(11) ZEROFILL NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    datanasc DATE NOT NULL,
    ncasa INTEGER(5) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    complemento VARCHAR(255),
    tipo VARCHAR(1) NOT NULL DEFAULT "C" CHECK (tipo IN ('C', 'A')),
    ativo VARCHAR(1) NOT NULL DEFAULT "S" CHECK (ativo IN ('S', 'N')),
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
    construcao VARCHAR(1) NOT NULL CHECK (construcao IN ('R', 'C')),
    raio INTEGER NOT NULL
);

CREATE TABLE tb_pneus (
    codpneu INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomepneu VARCHAR(150) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    tipo VARCHAR(1) NOT NULL CHECK (tipo IN ('C', 'R', 'O')),  /*verificar qual tipo ele é, se é caminhao(C), se é carreta(R), se é onibus (O) */
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


/*TABELA CIDADES*/



INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (1, 'PR', 'Cascavel');
    
INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (2, 'PR', 'Toledo');
    


INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (3, 'SC', 'Joinville');




/*TABELA CLIENTES*/



INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (1, 'Célia', 'Rua Parana', '12345678901', '987654321', 'celia_me_da_nota_plz@gmail.com', MD5('senha123'), '1990-01-01', '123', 'Centro', 'Casa portão preto', 'C', 'S', 1);
    
    
    INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES
    (2, 'Matheus', 'Rua dos Tropeiros', '98765432101', '123456789', 'melhor_mortis_do_brasil@gmail.com', MD5('admin123'), '1985-01-01',  '456', 'Tropical', 'Casa Esquina', 'A', 'S', 2);
    
    
   INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (3, 'Elliot', 'Rua Pernambuco', '99945678881', '131554321', 'fsociety@gmail.com', MD5('mrrobot'), '1998-10-28', '158', 'Centro', 'apartamento cinza', 'C', 'S', 3);





/*TABELA PNEUS*/



INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES 

    ('bridgestone', 'pneu novo da briegstone', 'C', '200,00' );
    
    
INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES     
    ('nuncafura', 'pneu recapado pela empresa', 'R', '230,00' );
    
    
    
INSERT INTO tb_pneus ( nomepneu, descricao, tipo, preco)
VALUES 
    ('goodyear', 'pneu da melhor recapagem', 'O', '500,00' );





/*TABELA MEDIDAS*/



INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (205, 15, 55, 65, 95, 210, 'R', 16);
    
INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES     
    (185, 14, 70, 60, 89, 190, 'C', 15);
    
INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES     
    (225, 16, 60, 75, 100, 240, 'R', 17);




/*TABELA COMPRAS*/    
INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Rua Parana, 123 - Centro', 101, 20.00, 1, '2023-08-15', 1);
    
INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES     
    (FALSE, 'Rua dos Tropeiros, 456 - Tropical', 102, 25.00, 2, '2023-09-01', 2);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES     
    (TRUE, 'Rua Pernambuco, 158 - Centro', 103, 30.00, 3, '2023-09-02', 3);


    /* TABELA COMPRA PNEUS */


INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (2, 200.00, 1, 1);
   
INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES    
    (1, 230.00, 2, 2);
   
INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES    
    (4, 500.00, 3, 3);




INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES     
    ('http://example.com/bridgestone.jpg', 'bridgestone', 1);
   
INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES    
    ('http://example.com/nuncafura.jpg', 'nuncafura', 2);
   
INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES    
    ('http://example.com/goodyear.jpg', 'goodyear', 3);
