# Catálogo de Livros — CRUD

Sistema de cadastro e gerenciamento de livros (título, autor, categoria e status), em HTML, CSS, JavaScript e PHP com MySQL.

## Como executar

1. Instale o XAMPP e inicie os módulos Apache e MySQL.
2. **Importante:** copie esta pasta inteira para dentro de `htdocs` do XAMPP (ex: `C:\xampp\htdocs\catalogodelivros`) — o Apache só executa arquivos PHP que estejam dentro dessa pasta.
3. Acesse `localhost/phpmyadmin`, crie um banco chamado `catalogodelivros` e rode `database/schema.sql` na aba SQL (já cria a tabela e insere livros de exemplo).
4. Se usou outro nome de banco, ajuste `$dbname` em `config/database.php`.
5. Acesse `localhost/catalogodelivros/index.php`.

## Funcionalidades

- Criar, listar, editar e excluir livros, com validação no navegador e no servidor.
- Confirmação antes de excluir um livro.

## Diferenciais implementados

- Persistência dos dados em banco de dados MySQL (em vez de arquivo texto).
- Validação extra para impedir cadastro de livro duplicado (mesmo título e autor).
- Campo de filtro por status na listagem.

## Observações

- O CSS (estilização visual) deste projeto foi desenvolvido com apoio de uma IA.
- Este é um CRUD simples de cadastro, como pedido no desafio — não foi implementada uma simulação real de empréstimo (quem pegou, prazo de devolução), apenas o cadastro com o campo de status (disponível/emprestado).
