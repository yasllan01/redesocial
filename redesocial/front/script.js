
document.addEventListener("DOMContentLoaded", function () {

    // CONTADOR DE CARACTERES
    const textarea = document.querySelector("#conteudo");
    const contador = document.querySelector("#contador");

    if (textarea && contador) {
        textarea.addEventListener("input", function () {
            contador.textContent = textarea.value.length + "/2000";
        });
    }

    // CONFIRMAR SAÍDA
    const linkSair = document.querySelector("#link-sair");

    if (linkSair) {
        linkSair.addEventListener("click", function (event) {
            const confirmar = confirm("Deseja realmente sair da sua conta?");

            if (!confirmar) {
                event.preventDefault();
            }
        });
    }

});
