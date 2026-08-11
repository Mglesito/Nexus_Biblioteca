CREATE TABLE aluno 
( 
 cpf INT PRIMARY KEY,  
 nome VARCHAR NOT NULL,  
 ano INT NOT NULL,  
 turma VARCHAR NOT NULL,  
 curso VARCHAR NOT NULL,  
 endereco VARCHAR NOT NULL,  
 bairro VARCHAR NOT NULL,  
 contato INT NOT NULL,  
 data_entrada DATETIME NOT NULL,  
 email VARCHAR NOT NULL,  
); 

CREATE TABLE livro 
( 
 registro INT,  
 autor VARCHAR NOT NULL,  
 titulo VARCHAR NOT NULL,  
 id INT PRIMARY KEY AUTO_INCREMENT,  
 status VARCHAR NOT NULL,  
); 

CREATE TABLE tombo 
( 
 registro INT PRIMARY KEY,  
 data_entrada DATETIME NOT NULL,  
 autor VARCHAR NOT NULL,  
 titulo VARCHAR NOT NULL,  
 volume INT NOT NULL,  
 exemplar INT NOT NULL,  
 edicao INT NOT NULL,  
 ano DATE NOT NULL,  
 local VARCHAR NOT NULL,  
 tipo_aquisicao VARCHAR NOT NULL,  
 codigo_genero INT NOT NULL,  
); 

CREATE TABLE emprestimo 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 data_emprestimo DATE NOT NULL,  
 data_devolucao DATE NOT NULL,  
 devolvido BOOLEAN NOT NULL,  
 cpf INT,  
); 

CREATE TABLE usuario 
( 
 email VARCHAR NOT NULL,  
 senha VARCHAR NOT NULL,  
 tipo_usuario INT NOT NULL,  
 cpf INT PRIMARY KEY,  
); 

CREATE TABLE bibliotecario 
( 
 nome VARCHAR NOT NULL,  
 cpf INT PRIMARY KEY,  
 senha VARCHAR NOT NULL,  
); 

CREATE TABLE suporte 
( 
 nome VARCHAR NOT NULL,  
 cpf INT PRIMARY KEY,  
 senha VARCHAR NOT NULL,  
); 

ALTER TABLE livro ADD FOREIGN KEY(registro) REFERENCES tombo (registro)
ALTER TABLE emprestimo ADD FOREIGN KEY(cpf) REFERENCES usuario (cpf)
ALTER TABLE usuario ADD FOREIGN KEY(cpf) REFERENCES aluno (cpf)
