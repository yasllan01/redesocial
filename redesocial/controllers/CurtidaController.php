
<?php

require_once __DIR__ . "/../models/CurtidaModel.php";

function curtir($con) {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return "Método inválido.";
    }

    if (!isset($_SESSION["usuario_id"])) {
        return "Você precisa estar logado.";
    }

    $publicacao_id = filter_input(
        INPUT_POST,
        "publicacao_id",
        FILTER_VALIDATE_INT
    );

    if (!$publicacao_id || $publicacao_id < 1) {
        return "Publicação inválida.";
    }

    $usuario_id = $_SESSION["usuario_id"];

    if (verificarCurtida($con, $usuario_id, $publicacao_id)) {
        descurtirPublicacao($con, $usuario_id, $publicacao_id);
    } else {
        try {
            curtirPublicacao($con, $usuario_id, $publicacao_id);
        } catch (PDOException $e) {
            return "Não foi possível registrar a curtida.";
        }
    }

    return true;
}
