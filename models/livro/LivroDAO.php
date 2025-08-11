<?php
require_once __DIR__ . '/../livro/Livro.php';
require_once __DIR__ . '/../../config/Database.php';

class LivroDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos($usuario_id) {
        $query = "SELECT * FROM livros WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        $livros = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $livros[] = new Livro($row);
        }
        return $livros;
    }

    public function buscarPorId($id, $usuario_id) {
        $query = "SELECT * FROM livros WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Livro($row) : null;
    }

    public function criar(Livro $livro) {
        $query = "INSERT INTO livros (titulo, autor, ano_publicacao, isbn, usuario_id) 
                  VALUES (:titulo, :autor, :ano_publicacao, :isbn, :usuario_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':titulo', $livro->getTitulo());
        $stmt->bindParam(':autor', $livro->getAutor());
        $stmt->bindParam(':ano_publicacao', $livro->getAnoPublicacao());
        $stmt->bindParam(':isbn', $livro->getIsbn());
        $stmt->bindParam(':usuario_id', $livro->getUsuarioId());
        
        return $stmt->execute();
    }

    public function atualizar(Livro $livro) {
        $query = "UPDATE livros SET 
                  titulo = :titulo, 
                  autor = :autor, 
                  ano_publicacao = :ano_publicacao, 
                  isbn = :isbn 
                  WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':titulo', $livro->getTitulo());
        $stmt->bindParam(':autor', $livro->getAutor());
        $stmt->bindParam(':ano_publicacao', $livro->getAnoPublicacao());
        $stmt->bindParam(':isbn', $livro->getIsbn());
        $stmt->bindParam(':id', $livro->getId());
        $stmt->bindParam(':usuario_id', $livro->getUsuarioId());
        
        return $stmt->execute();
    }

    public function deletar($id, $usuario_id) {
        $query = "DELETE FROM livros WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        return $stmt->execute();
    }
}
?>