<?php

require "config.php";

$rota = $_GET["rota"] ?? "teste";

function teste() {

    echo "API funcionando!";

}

function create($con) {

    $nome = $_POST["Nome"] ?? "";
    $email = $_POST["Email"] ?? "";
    $telefone = $_POST["Telefone"] ?? "";
    $endereco = $_POST["Endereco"] ?? "";

    $sql = "INSERT INTO Clientes (Nome, Email, Telefone, Endereco)
            VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);

    $stmt->execute([
        $nome,
        $email,
        $telefone,
        $endereco
    ]);

    echo "Cliente cadastrado com sucesso!";
}

function read($con) {

    header("Content-Type: application/json; charset=utf-8");

    $stmt = $con->query("SELECT * FROM Clientes");

    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC)
    );
}

switch ($rota) {

    case "clientes/create":

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            create($con);
        }

        break;

    case "clientes":

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            read($con);
        }

        break;

    default:

        teste();

        break;
}