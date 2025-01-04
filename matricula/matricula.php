<?php
@include 'conexao.php';
session_start();
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
  <title>Formulário de Matrícula</title>
</head>
<body>

  <div class="form-container">
    <h2>Formulário de Matrícula</h2>
    <form action="submit.php" method="POST">
      <div class="form-row">
        
        <!-- Informações do Aluno -->
        <div class="form-section">
          <h3>Informações do Aluno</h3>
          
          <label for="nome-aluno">Nome Completo:</label>
          <input type="text" id="nome-aluno" name="nome-aluno" required>
          
          <label for="cpf">CPF:</label>
          <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" required>
          
          <label for="serie">Série ou Ano Escolar:</label>
          <input type="text" id="serie" name="serie" placeholder="Ex.: 5º ano do ensino fundamental" required>
        </div>

        <!-- Informações dos Responsáveis -->
        <div class="form-section">
          <h3>Informações dos Responsáveis</h3>
          
          <label for="nome-responsavel">Nome Completo do Responsável Principal:</label>
          <input type="text" id="nome-responsavel" name="nome-responsavel" required>
          
          <label for="telefone-contato">Telefone de Contato:</label>
          <input type="tel" id="telefone-contato" name="telefone-contato" placeholder="(XX) XXXXX-XXXX" required>
          
          <label for="relacao-aluno">Relação com o Aluno:</label>
          <select id="relacao-aluno" name="relacao-aluno" required>
            <option value="pai">Pai</option>
            <option value="mãe">Mãe</option>
            <option value="tutor">Tutor</option>
            <option value="outro">Outro</option>
          </select>
        </div>

      </div>

      <!-- Botões de Envio e Voltar -->
      <div class="button-row">
        <?php
        if (isset($_SESSION['mensagem'])) {
          echo "<p class='error-message'>" . $_SESSION['mensagem'] . "</p>";
          unset($_SESSION['mensagem']);
        }
        ?>
        <a href="../index.html"><button type="button" class="back-btn">Voltar</button></a>
        <button type="submit" class="submit-btn">Enviar Matrícula</button>
      </div>

      <!-- Link 'Já tenho matrícula' -->
      <div class="already-enrolled">
        <a href="login.php">Já tenho matrícula!</a>
      </div>

    </form>
  </div>

</body>
</html>
