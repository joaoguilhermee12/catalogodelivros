<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros</title>
    <link rel="stylesheet" href="frontend/style.css">
</head>
<body>
    <header>
        <h1>Catálogo de Livros</h1>
        <a href="criar.php" class="botao-novo">+ Novo livro</a>
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
                <?php
                include 'config/database.php';

                $stmt = $pdo->query("SELECT * FROM livros ORDER BY titulo");
                $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($livros as $livro):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                        <td><?= htmlspecialchars($livro['categoria']) ?></td>
                        <td><?= htmlspecialchars($livro['status']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $livro['id'] ?>">Editar</a>
                            <a href="excluir.php?id=<?= $livro['id'] ?>" class="btn-excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="frontend/validacao.js"></script>
</body>
</html>