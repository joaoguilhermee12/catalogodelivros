CREATE TABLE livros ( 
    id int AUTO_INCREMENT PRIMARY KEY,
    titulo varchar (100) NOT NULL,
    autor varchar (100) NOT NULL, 
    categoria varchar (100) NOT NULL,
    status ENUM ('Disponivel', 'Emprestado') NOT NULL DEFAULT 'Disponivel' ); 
     -- Rode esse código no seu banco de dados para criar a tabela de livros em localhost/phpmyadmin pelo XAMPP. 