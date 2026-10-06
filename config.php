<?php

try {

    $con = new PDO(
        "mysql:host=localhost;dbname=LojaTI;charset=utf8",
        "root",
        ""
    );

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "erro" => "Erro na conexão com o banco"
    ]);

    exit;
}