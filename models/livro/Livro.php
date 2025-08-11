<?php
class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $ano_publicacao;
    private $isbn;
    private $usuario_id;

    public function __construct($dados = []) {
        if (isset($dados['id'])) $this->id = $dados['id'];
        if (isset($dados['titulo'])) $this->titulo = $dados['titulo'];
        if (isset($dados['autor'])) $this->autor = $dados['autor'];
        if (isset($dados['ano_publicacao'])) $this->ano_publicacao = $dados['ano_publicacao'];
        if (isset($dados['isbn'])) $this->isbn = $dados['isbn'];
        if (isset($dados['usuario_id'])) $this->usuario_id = $dados['usuario_id'];
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getAnoPublicacao() { return $this->ano_publicacao; }
    public function getIsbn() { return $this->isbn; }
    public function getUsuarioId() { return $this->usuario_id; }

    // Setters
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setAnoPublicacao($ano) { $this->ano_publicacao = $ano; }
    public function setIsbn($isbn) { $this->isbn = $isbn; }
    public function setUsuarioId($id) { $this->usuario_id = $id; }
}
?>