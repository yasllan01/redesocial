
<?php

require_once __DIR__ . "/../models/PublicacaoModel.php";

// CRIAR PUBLICAÇÃO
function publicar($con) {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    if (!isset($_SESSION["usuario_id"])) {
        return "Você precisa estar logado.";
    }

    $conteudo = trim($_POST["conteudo"] ?? "");

    if ($conteudo === "") {
        return "A publicação não pode ficar vazia.";
    }

    if (strlen($conteudo) > 2000) {
        return "A publicação deve ter no máximo 2000 caracteres.";
    }

    criarPublicacao(
        $con,
        $_SESSION["usuario_id"],
        $conteudo
    );

    return true;
}
