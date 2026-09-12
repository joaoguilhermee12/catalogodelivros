<?php
include 'config/database.php';

$statusFiltro = $_GET['status'] ?? '';
$statusPermitidos = ['', 'Disponivel', 'Emprestado'];

if (!in_array($statusFiltro, $statusPermitidos, true)) {
    $statusFiltro = '';
}

if ($statusFiltro !== '') {
    $stmt = $pdo->prepare("SELECT * FROM livros WHERE status = ? ORDER BY titulo");
    $stmt->execute([$statusFiltro]);
} else {
    $stmt = $pdo->query("SELECT * FROM livros ORDER BY titulo");
}

$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros</title>
    <link rel="stylesheet" href="front/style.css">
</head>
<body>
    <header>
        <h1>Catálogo de Livros</h1>
        <a href="criar.php" class="botao-novo">+ Novo livro</a>

        <form method="GET" action="index.php" class="filtro">
            <label for="status">Filtrar por status:</label>
            <select id="status" name="status" onchange="this.form.submit()">
                <option value="">Todos</option>
                <option value="Disponivel" <?= $statusFiltro === 'Disponivel' ? 'selected' : '' ?>>Disponível</option>
                <option value="Emprestado" <?= $statusFiltro === 'Emprestado' ? 'selected' : '' ?>>Emprestado</option>
            </select>
        </form>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td data-label="Título"><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td data-label="Autor"><?= htmlspecialchars($livro['autor']) ?></td>
                        <td data-label="Categoria"><?= htmlspecialchars($livro['categoria']) ?></td>
                        <td data-label="Status"><?= htmlspecialchars($livro['status']) ?></td>
                        <td data-label="Ações">
                            <a href="editar.php?id=<?= $livro['id'] ?>">Editar</a>
                            <a href="excluir.php?id=<?= $livro['id'] ?>" class="btn-excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="front/validacao.js"></script>
</body>
</html>