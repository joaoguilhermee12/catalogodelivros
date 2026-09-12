
<?php if (!empty($erro)): ?>
    <p class="erro"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Livro</title>
    <link rel="stylesheet" href="frontend/style.css">
</head>
<body>
    <header>
        <h1>Cadastrar Livro</h1>
        <a href="index.php">← Voltar</a>
    </header>

    <main>
      <?php
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $categoria = trim($_POST['categoria']);
    $status = $_POST['status'];

    if (empty($titulo) || empty($autor)) {
        $erro = "Título e autor são obrigatórios.";
    } else {
        include 'config/database.php';

        $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, categoria, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titulo, $autor, $categoria, $status]);

        header('Location: index.php');
        exit;
    }
}
?>

        <form method="POST" action="criar.php">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" required>

            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria">

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Disponivel">Disponível</option>
                <option value="Emprestado">Emprestado</option>
            </select>

            <button type="submit">Salvar</button>
        </form>
    </main>

    <script src="frontend/validacao.js"></script>
</body>
</html>