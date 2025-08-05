<?php
class login 

// Conexão com o banco de dados
mysql_connect("localhost", "usuario", "senha");
mysql_select_db("banco");
// Recuperando os dados do formulário
$LoginUsuario = $_POST["LoginUsuario"];
$SenhaUsuario = $_POST["SenhaUsuario"];
// Incluimos a classe
require_once("login.class.php");
/* 
Instanciamos a classe. A função Login(), aceita como parametros facultativos: 
nome da tabela, n   me do campo de login, nome do campo de senha, mensagem de erro.
Por padrão, o nome da tabela é "usuarios", o campo de login é "login", o de senha é "senha"
e a mensagem de erro é "Login ou senha inválido".
*/
$login = new Login();
/* 
Realizamos o login através da função logar() da classe, 
que aceita como parametro obrigatório: o login e a senha. 
E como terceiro parametro: página que o usuário será redirecionado. 
Ou seja: logar(login, senha, redirecionamento)
*/
$logar = $login->logar($LoginUsuario, $SenhaUsuario, "area_restrita.php");
// Se o login ou senha estiver incorreto, exibe mensagem de erro
if ($logar)
    echo $logar;
?>