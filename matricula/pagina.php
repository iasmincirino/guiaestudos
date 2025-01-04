<?php
@include 'conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php"); // Redireciona para o login se não estiver logado
    exit();
}

// Recupera o CPF do usuário logado
$cpf = $_SESSION['cpf'];

// Consulta o banco para obter o nome do estudante
$sql = "SELECT nome_aluno FROM alunos WHERE cpf = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o estudante
if ($result->num_rows > 0) {
    $aluno = $result->fetch_assoc();
    $nomeAluno = $aluno['nome_aluno'];
} else {
    // Se o CPF não for encontrado, encerra a sessão e redireciona
    session_destroy();
    header("Location: login.php");
    exit();
}

// Função de logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="pag.css">
    <!--Icon-->
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <title>Matrícula</title>
</head>
<body>

<section class="home" id="home">
    <div class="content">
        <h3>Parabéns pela sua matrícula! <span><?php echo htmlspecialchars($nomeAluno); ?>!</span></h3>
        <p>Agora você está oficialmente matriculado! Temos certeza de que você fez a melhor escolha ao se juntar à nossa escola. Aqui, você encontrará um ambiente de aprendizado acolhedor, professores dedicados e oportunidades incríveis para crescer e se desenvolver. Seja Bem-vindo(a)</p>
        <a href="../index.html" class="btn">Início</a>
        <a href="?logout=true" class="btn">Logout</a>
    </div>

    <div class="image">
        <img src="../img/pag.svg" alt="">
    </div>
</section>

</body>
</html>
