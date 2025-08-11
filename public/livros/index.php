<?php
require_once '../../utils/Auth.php';
require_once '../../models/LivroDAO.php';

Auth::verificar();
$usuario_id = Auth::getUsuarioId();

$dao = new LivroDAO();
$livros = $dao->listarTodos($usuario_id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Meus Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Meus Livros</h1>
            <div>
                <a href="create.php" class="btn btn-primary">Adicionar Livro</a>
                <a href="../auth/logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
        
        <?php if (count($livros) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>ISBN</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?= htmlspecialchars($livro->getTitulo()) ?></td>
                            <td><?= htmlspecialchars($livro->getAutor()) ?></td>
                            <td><?= htmlspecialchars($livro->getAnoPublicacao()) ?></td>
                            <td><?= htmlspecialchars($livro->getIsbn()) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $livro->getId() ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="delete.php?id=<?= $livro->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Nenhum livro cadastrado ainda.</div>
        <?php endif; ?>
    </div>
</body>
</html>