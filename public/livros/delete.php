<?php
require_once '../../utils/Auth.php';
require_once '../../models/LivroDAO.php';

Auth::verificar();
$usuario_id = Auth::getUsuarioId();

$dao = new LivroDAO();
if (isset($_GET['id'])) {
    $dao->deletar($_GET['id'], $usuario_id);
}

header('Location: index.php');
exit();
?>