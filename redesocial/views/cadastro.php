
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro | RedeSocial</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #1756a5, #70a8ed);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.caixa {
    background: white;
    width: 100%;
    max-width: 440px;
    padding: 35px;
    border-radius: 17px;
    box-shadow: 0 15px 40px #00000025;
}

h1 {
    color: #2874d0;
    text-align: center;
    margin-bottom: 10px;
}

.subtitulo {
    text-align: center;
    color: #8490a3;
    margin-bottom: 25px;
}

label {
    display: block;
    margin: 14px 0 7px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
}

input:focus {
    border-color: #2874d0;
}

button {
    width: 100%;
    padding: 14px;
    background: #2874d0;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    margin-top: 23px;
    cursor: pointer;
}

.final {
    text-align: center;
    color: #777;
    margin-top: 22px;
}

a {
    color: #2874d0;
    font-weight: bold;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="caixa">

    <h1>RedeSocial.</h1>

    <p class="subtitulo">Crie sua conta e faça parte!</p>

    <form action="../api.php?rota=cadastrar" method="POST">

        <label>Nome completo</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>

        <label>Nome de usuário</label>
        <input type="text" name="username" placeholder="Escolha seu usuário" required>

        <label>E-mail</label>
        <input type="email" name="email" placeholder="Digite seu e-mail" required>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="Crie sua senha" required>

        <button type="submit">Criar minha conta</button>

    </form>

    <p class="final">
        Já possui uma conta?
        <a href="login.php">Entrar</a>
    </p>

</div>

</body>
</html>
