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
    token VARCHAR(250),
    token_expira DATETIME,
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
    token VARCHAR(255),
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

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (4, 'RS', 'Porto Alegre');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (5, 'PR', 'Curitiba');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (6, 'SC', 'Blumenau');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (7, 'RS', 'Canoas');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (8, 'PR', 'Londrina');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (9, 'SC', 'Florianópolis');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (10, 'RS', 'Pelotas');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (11, 'PR', 'Ponta Grossa');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (12, 'SC', 'Chapecó');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (13, 'RS', 'Santa Maria');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (14, 'PR', 'Maringá');

INSERT INTO tb_cidades (codcidade, estado, nome)
VALUES 
    (15, 'SC', 'Itajaí');



/*TABELA CLIENTES*/



INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (1, 'Célia', 'Rua Parana', '12345678901', '987654321', 'celia_me_da_nota_plz@gmail.com', MD5('senha123'), '1990-01-01', '123', 'Centro', 'Casa portão preto', 'C', 'S', 1);
      
    INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES
    (2, 'Matheus', 'Rua dos Tropeiros', '98765432101', '123456789', 'admamazonia@gmail.com', MD5('admin123'), '1985-01-01',  '456', 'Tropical', 'Casa Esquina', 'A', 'S', 2);
        
   INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (3, 'Elliot', 'Rua Pernambuco', '99945678881', '131554321', 'fsociety@gmail.com', MD5('mrrobot'), '1998-10-28', '158', 'Centro', 'apartamento cinza', 'C', 'S', 3);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (4, 'Carlos', 'Rua XV de Novembro', '11122233344', '999999999', 'carlos@example.com', MD5('senha123'), '1990-05-10', '100', 'Centro', 'Prédio Azul', 'C', 'S', 4);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (5, 'Ana', 'Rua das Flores', '22233344455', '888888888', 'ana@example.com', MD5('senha123'), '1992-06-15', '200', 'Jardim', 'Casa Verde', 'C', 'S', 5);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (6, 'Pedro', 'Avenida Brasil', '33344455566', '777777777', 'pedro@example.com', MD5('senha123'), '1988-03-22', '150', 'Industrial', 'Sem complemento', 'C', 'S', 6);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (7, 'Lucas', 'Rua Santos Dumont', '44455566677', '666666666', 'lucas@example.com', MD5('senha123'), '1995-02-12', '75', 'Aeroporto', 'Apartamento 305', 'C', 'S', 7);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (8, 'Juliana', 'Avenida Independência', '55566677788', '555555555', 'juliana@example.com', MD5('senha123'), '1993-11-20', '80', 'Vila Nova', 'Sobrado', 'C', 'S', 8);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (9, 'Roberta', 'Rua Getúlio Vargas', '66677788899', '444444444', 'roberta@example.com', MD5('senha123'), '1994-07-30', '220', 'Pinheiros', 'Casa de esquina', 'C', 'S', 9);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (10, 'Felipe', 'Rua da Harmonia', '77788899900', '333333333', 'felipe@example.com', MD5('senha123'), '1991-09-17', '85', 'Santa Clara', 'Casa amarela', 'C', 'S', 10);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (11, 'Carlos Eduardo', 'Avenida Central', '12312312345', '888888888', 'carlos.edu@example.com', MD5('senha123'), '1990-02-15', '202', 'Centro', 'Casa com garagem', 'C', 'S', 2);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (12, 'Mariana Oliveira', 'Rua das Palmeiras', '45645645678', '777777777', 'mariana.oliver@example.com', MD5('senha123'), '1992-10-10', '15', 'Jardim Tropical', 'Casa de esquina', 'C', 'S', 3);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (13, 'Rafael Souza', 'Avenida das Américas', '78978978901', '666666666', 'rafael.souza@example.com', MD5('senha123'), '1985-08-08', '35', 'Vila Nova', 'Apartamento 5', 'C', 'S', 1);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (14, 'Patrícia Santos', 'Rua das Acácias', '14714714785', '555555555', 'patricia.santos@example.com', MD5('senha123'), '1995-04-04', '47', 'Centro', 'Casa com jardim', 'C', 'S', 2);

INSERT INTO tb_clientes (codcliente, nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento, tipo, ativo, codcidade)
VALUES 
    (15, 'Rodrigo Almeida', 'Rua das Hortênsias', '36936936985', '444444444', 'matheusrodrigues58277@gmail.com', MD5('macaco'), '1989-12-12', '57', 'Jardim das Flores', 'Apartamento 2', 'C', 'S', 3);






/*TABELA PNEUS*/



INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Michelin X Multiway', 'Pneu de alta performance para caminhões de carga', 'C', 450.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Continental HSC1', 'Pneu robusto para caminhões com alta durabilidade', 'C', 470.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Pirelli FG01', 'Pneu especializado para caminhões rodoviários', 'C', 500.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Bridgestone M729', 'Pneu resistente para caminhões de longa distância', 'C', 510.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Goodyear KMax', 'Pneu econômico e durável para caminhões pesados', 'C', 490.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Dunlop SP 320', 'Pneu ideal para caminhões de carga média', 'C', 440.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Firestone FS591', 'Pneu para caminhões de uso misto, estrada e urbano', 'C', 460.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Yokohama TY517', 'Pneu de longa duração para caminhões de grande porte', 'C', 480.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Hankook DL11', 'Pneu para caminhões com tração reforçada', 'C', 465.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('BFGoodrich Cross ', 'Pneu para resistência em condições severas', 'C', 455.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Toyo M647', 'Pneu de alta eficiência para caminhões de longa distância', 'C', 475.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Sumitomo ST719', 'Pneu versátil para caminhões de carga pesada', 'C', 430.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Kumho KRS50', 'Pneu reforçado para caminhões de carga', 'C', 445.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Maxxis M9208', 'Pneu especializado para caminhões off-road', 'C', 460.00);

INSERT INTO tb_pneus (nomepneu, descricao, tipo, preco)
VALUES 
    ('Apollo Endurace RA', 'Pneu resistente para caminhões de entrega', 'C', 435.00);




/*TABELA MEDIDAS*/


INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (315, 22, 80, 70, 154, 210, 'R', 22);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (295, 22, 75, 65, 152, 190, 'R', 22);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (305, 20, 85, 70, 150, 200, 'R', 20);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (285, 19, 70, 65, 145, 180, 'C', 19);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (275, 19, 75, 70, 143, 175, 'R', 19);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (265, 18, 65, 60, 140, 170, 'C', 18);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (245, 18, 70, 65, 137, 160, 'R', 18);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (255, 17, 65, 60, 134, 155, 'C', 17);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (235, 17, 70, 65, 130, 150, 'R', 17);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (225, 16, 75, 70, 125, 140, 'C', 16);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (215, 16, 80, 75, 123, 135, 'R', 16);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (205, 15, 85, 80, 120, 130, 'C', 15);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (195, 15, 70, 65, 118, 125, 'R', 15);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (185, 14, 75, 70, 115, 120, 'C', 14);

INSERT INTO tb_medidas (largura, aro, medida, altura, indicecarga, velocidade, construcao, raio)
VALUES 
    (175, 14, 80, 75, 110, 115, 'R', 14);




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

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Avenida Brasil, 1000', 104, 18.50, 1, '2023-07-21', 4);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (FALSE, 'Rua Santos Dumont, 75', 105, 22.00, 2, '2023-09-11', 5);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Rua Getúlio Vargas, 300', 106, 20.00, 3, '2023-06-15', 6);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (FALSE, 'Avenida Independência, 85', 107, 19.00, 1, '2023-10-04', 7);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Rua da Harmonia, 85', 108, 21.50, 2, '2023-08-22', 8);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (FALSE, 'Rua Tibagi, 130', 109, 18.00, 3, '2023-07-17', 9);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Rua Amazonas, 300', 110, 25.00, 1, '2023-11-08', 10);

INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente)
VALUES 
    (TRUE, 'Avenida das Américas, 50', 111, 30.00, 2, '2023-08-05', 11);    


    /* TABELA COMPRA PNEUS */


INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (5, 200.00, 1, 1);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (2, 230.00, 2, 2);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (4, 500.00, 3, 3);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (6, 250.00, 1, 4);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (3, 300.00, 2, 5);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (7, 450.00, 3, 6);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (2, 220.00, 1, 7);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (8, 280.00, 2, 8);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (1, 190.00, 3, 9);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (5, 350.00, 1, 10);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (3, 270.00, 2, 11);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (4, 380.00, 3, 12);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (6, 210.00, 1, 13);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (9, 320.00, 2, 14);

INSERT INTO tb_compras_pneus (qntd, preco, codcompra, codpneu)
VALUES 
    (7, 430.00, 3, 15);



/*TABELA DE IMAGENS */


INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://aecbmesvcm.cloudimg.io/v7/https://cxf-prod.azureedge.net/b2b-experience-production/attachments/ckaz1ze9n020r01hhj787iga5-tyre-x-multiway-3d-xze-xde-22-5-persp-perspective.full.png', 'Bridgestone Truck', 1);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://www.conti.com.br/adobe/dynamicmedia/deliver/dm-aid--b22c09e6-2386-489d-816b-507053d0ddb5/Continental__HSC1___ProductPicture__30__ZZ_STAT_DIM__275_80_R_22_5.webp?preferwebp=true&quality=85&width=950', 'Continental Truck', 2);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://www.bellenzier.com.br/media/tmp/webp/catalog/product/cache/1/image/600x/9df78eab33525d08d6e5fb8d27136e95/2/9/295_80_r22.5_pneu_pirelli_prometeon_fg_01_plus_caminhao_152_148_l_tl_1.webp', 'Goodyear Truck', 3);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://dellavia.vteximg.com.br/arquivos/ids/161961-1000-1000/M729.jpg?v=638459524585130000', 'Michelin Truck', 4);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_738907-MLB74325608688_022024-O.webp', 'Pirelli Truck', 5);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_851940-MLB75509043082_042024-O.webp', 'Hankook Truck', 6);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_901307-MLU77135560780_062024-O.webp', 'BFGoodrich Truck', 7);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_851940-MLB75509043082_042024-O.webp', 'Dunlop Truck', 8);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://www.hankooktire.com/content/dam/hankooktire/local/img/product-detil-page/tire-list-thumbnail/tbr/DL11_normal.png', 'Toyo Tires Truck', 9);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_622601-MLU77402084433_072024-O.webp', 'Yokohama Truck', 10);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWtjji-Wg6xUv3NrsVKRK8eOtc3qUfZQB4iQ&s', 'Falken Truck', 11);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://cdn11.bigcommerce.com/s-dzuemmesww/products/4807/images/5069/5321__15220.1673642914.386.513.jpg?c=1', 'Kumho Truck', 12);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_752583-MLB74779415533_022024-O.webp', 'Maxxis Truck', 13);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://http2.mlstatic.com/D_NQ_NP_752583-MLB74779415533_022024-O.webp', 'Cooper Truck', 14);

INSERT INTO tb_imagens (url, nomeimg, codpneu)
VALUES 
    ('https://autoamerica.com.br/wp-content/uploads/2022/12/EnduRace-RA.png', 'General Tire Truck', 15);
