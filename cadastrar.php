<?php
include("conecta.php");
$id = $_POST["id"];
$login = $_POST["login"];
$senha     = $_POST["senha"];
$cep   = $_POST["cep"];
$descricao   = $_POST["descricao"];
$adm   = $_POST["adm"];
//SE CLICOU NO BOTÃO INSERIR

$comando = $pdo->prepare("INSERT INTO cadastro VALUES('$id','$login','$senha','$cep','$descricao','n')");
$resultado = $comando->execute();

$resultado = $comando->execute();
header("Location: html/adm.php");

//transformando cep em cidade/estado
$url = "https://viacep.com.br/ws/{$cep}/json/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Se o CEP não foi encontrado, podemos redirecionar para uma página de erro
if (isset($data['erro'])) {
    // Aqui você pode definir o que fazer se o CEP não for válido
    // Por exemplo, redirecionar para uma página de erro:
    // header("Location: errorPage.html");
    exit;
} else {
    $logradouro = $data['logradouro'];
    $bairro = $data['bairro'];
    $cidade = $data['localidade'];
    $estado = $data['uf'];
}

?>



