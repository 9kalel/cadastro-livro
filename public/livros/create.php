<?php
require_once '../../utils/Auth.php';
require_once '../../models/LivroDAO.php';

Auth::verificar();
$usuario_id = Auth::getUsuarioId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro = new Livro([
        'titulo' => $_POST['titulo'],
        'autor' => $_POST['autor'],
        'ano_publicacao' => $_POST['ano_publicacao'],
        'isbn' => $_POST['isbn'],
        'usuario_id' => $usuario_id
    ]);
    
    $dao = new LivroDAO();
    if ($dao->criar($livro)) {
        header('Location: index.php');
        exit();
    } else {
        $erro = "Erro ao cadastrar livro";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Adicionar Livro</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger"><?= $erro ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" required>
                            </div>
                            <div class="mb-3">
                                <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
                                <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" required>
                            </div>
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
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