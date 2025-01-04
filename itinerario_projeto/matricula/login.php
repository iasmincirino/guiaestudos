<?php
@include 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];

    // Verificar se o CPF está registrado no banco de dados
    $sqlCheckCPF = "SELECT * FROM alunos WHERE cpf = ?";
    $stmt = $conexao->prepare($sqlCheckCPF);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // CPF encontrado, armazena na sessão
        $_SESSION['cpf'] = $cpf;
    
        // Redirecionar para a página do aluno
        header("Location: pagina.php");
        exit();
    } else {
        // CPF não encontrado
        $_SESSION['mensagem'] = "CPF não encontrado. Verifique as informações ou realize a matrícula.";
    }    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="style.css">
    <!--Icon-->
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <title>Login de Matrícula</title>
</head>
<body>

<div class="form-container">
    <h2>Login de Matrícula</h2>

    <!-- Exibe mensagens de erro -->
    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "<p class='error-message'>" . $_SESSION['mensagem'] . "</p>";
        unset($_SESSION['mensagem']);
    }
    ?>

    <form action="login.php" method="POST">
        <div class="form-row">
            <div class="form-section">
                <label for="cpf">Digite o CPF do Aluno:</label>
                <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" required>
            </div>
        </div>

        <div class="button-row">
            <a href="matricula.php"><button type="button" class="back-btn">Voltar</button></a>
            <button type="submit" class="submit-btn">Login</button>
        </div>
    </form>
</div>

</body>
</html>
