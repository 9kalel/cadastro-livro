<?php
// Incluimos a classe
require_once("login.class.php");
// Instanciamos a classe
$login = new Login();
/* 
Utilizamos a função verificar() que verifica se o usuário está logado. 
Ela aceita como parâmetro facultativo para onde o usuário será redirecionado
caso ele não esteja logado. No caso, ele não estiver logado, 
será redirecionado para a página de login (login.php).
*/
$login->verificar("login.php");
/*
Se ele estiver logado, mostramos a mensagem de bem-vindo.
A váriavel $LoginUsuario é criada assim que é constado que o
usuário está logado.
*/
echo "Bem vindo " . $LoginUsuario;
?>