
<?php

function executarRota($con) {

    $rota = $_GET["rota"] ?? "";

    switch ($rota) {

        case "cadastrar":
            $resultado = cadastrar($con);

            if ($resultado === true) {
                header("Location: views/login.php");
                exit;
            }
            break;

        case "login":
            $resultado = login($con);

            if ($resultado === true) {
                header("Location: views/feed.php");
                exit;
            }
            break;

        case "publicar":
            $resultado = publicar($con);

            if ($resultado === true) {
                header("Location: views/feed.php");
                exit;
            }
            break;

        case "curtir":
            $resultado = curtir($con);

            if ($resultado === true) {
                header("Location: views/feed.php");
                exit;
            }
            break;

        case "sair":
            session_unset();
            session_destroy();

            header("Location: views/login.php");
            exit;

        default:
            $resultado = "Rota não encontrada.";
            break;
    }

    echo "<h3>" .
        htmlspecialchars($resultado ?? "Não foi possível realizar a ação.") .
        "</h3>";

    echo '<a href="javascript:history.back()">Voltar</a>';
}
