<?php
include 'config/database.php';
$erro = '';
$id = $_GET['id'] ?? $_POST['id'] ?? null;

$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->execute([$id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $status = $_POST['status'] ?? 'Disponivel';

    if (empty($titulo) || empty($autor)) {
        $erro = "Título e autor são obrigatórios.";
        $livro = ['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'categoria' => $categoria, 'status' => $status];
    } else {
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM livros WHERE titulo = ? AND autor = ? AND id != ?");
        $stmtCheck->execute([$titulo, $autor, $id]);

        if ($stmtCheck->fetchColumn() > 0) {
            $erro = "Já existe outro livro cadastrado com esse título e autor.";
            $livro = ['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'categoria' => $categoria, 'status' => $status];
        } else {
            $stmt = $pdo->prepare("UPDATE livros SET titulo = ?, autor = ?, categoria = ?, status = ? WHERE id = ?");
            $stmt->execute([$titulo, $autor, $categoria, $status, $id]);
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="front/style.css">
</head>
<body>
    <header>
        <h1>Editar Livro</h1>
        <a href="index.php">← Voltar</a>
    </header>

    <main>
        <?php if (!empty($erro)): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST" action="editar.php" id="form-livro">
            <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($livro['categoria']) ?>">

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Disponivel" <?= $livro['status'] === 'Disponivel' ? 'selected' : '' ?>>Disponível</option>
                <option value="Emprestado" <?= $livro['status'] === 'Emprestado' ? 'selected' : '' ?>>Emprestado</option>
            </select>

            <button type="submit">Salvar</button>
        </form>
    </main>

    <script src="front/validacao.js"></script>
</body>
</html>