<?php
session_start();

// Pega o input
$login = $_POST["login"];
$senha = $_POST["senha"];

// Conecta com o banco de dados
include("conecta.php");

// Prepara a consulta
$comando = $pdo->prepare("SELECT * FROM cadastro WHERE login = :login AND senha = :senha");

// Vincula os parâmetros
$comando->bindParam(":login", $login);
$comando->bindParam(":senha", $senha);

// Executa a consulta
$comando->execute();

// Verifica se a consulta retornou algum registro
if ($comando->rowCount() > 0) {
    // O usuário foi encontrado

    // Obtém o campo "adm" do registro encontrado
    $admin = $comando->fetch()["adm"];

    // Cria a sessão do usuário
    $_SESSION["logado"] = $login;

    // Redireciona o usuário para a página apropriada
    if ($admin == "s") {
        header("Location: html/adm.php");
    } else {
        header("Location: html/pagina1.php");
    }
} else {
    // O usuário não foi encontrado
    header("Location: index.html");
}

// Exibe o valor de $admin
echo $admin;
?>
