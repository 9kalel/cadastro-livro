<?php
require_once '../../utils/Auth.php';
require_once '../../models/LivroDAO.php';

Auth::verificar();
$usuario_id = Auth::getUsuarioId();

$dao = new LivroDAO();
$livro = $dao->buscarPorId($_GET['id'], $usuario_id);

if (!$livro) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro->setTitulo($_POST['titulo']);
    $livro->setAutor($_POST['autor']);
    $livro->setAnoPublicacao($_POST['ano_publicacao']);
    $livro->setIsbn($_POST['isbn']);
    
    if ($dao->atualizar($livro)) {
        header('Location: index.php');
        exit();
    } else {
        $erro = "Erro ao atualizar livro";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Editar Livro</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger"><?= $erro ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($livro->getTitulo()) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="<?= htmlspecialchars($livro->getAutor()) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
                                <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" value="<?= htmlspecialchars($livro->getAnoPublicacao()) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= htmlspecialchars($livro->getIsbn()) ?>" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>