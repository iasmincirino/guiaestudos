<?php
@include 'conexao.php';
session_start();

// Capturar os dados do formulário
$nomeAluno = $_POST['nome-aluno'];
$cpf = $_POST['cpf'];
$serie = $_POST['serie'];
$nomeResponsavel = $_POST['nome-responsavel'];
$telefoneContato = $_POST['telefone-contato'];
$relacaoAluno = $_POST['relacao-aluno'];

// Verificar se o CPF já existe no banco de dados
$sqlCheckCPF = "SELECT * FROM alunos WHERE cpf = ?";
$stmt = $conexao->prepare($sqlCheckCPF);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // CPF já existe
    $_SESSION['mensagem'] = "Essa matrícula já existe!";
    header("Location: matricula.php");
    exit();
} else {
    // Inserir o aluno no banco de dados
    $sqlInsertAluno = "INSERT INTO alunos (nome_aluno, cpf, serie) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sqlInsertAluno);
    $stmt->bind_param("sss", $nomeAluno, $cpf, $serie);

    if ($stmt->execute()) {
        // Obter o ID do aluno inserido
        $alunoId = $stmt->insert_id;
    
        // Inserir o responsável no banco de dados
        $sqlInsertResponsavel = "INSERT INTO responsaveis (responsavel, contato, relacao, aluno_id) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sqlInsertResponsavel);
        $stmt->bind_param("sssi", $nomeResponsavel, $telefoneContato, $relacaoAluno, $alunoId);
    
        if ($stmt->execute()) {
            // Armazena o CPF na sessão
            $_SESSION['cpf'] = $cpf;
    
            // Redirecionar para a página de sucesso
            header("Location: pagina.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro ao salvar o responsável. Tente novamente.";
            header("Location: matricula.php");
            exit();
        }
    }    
}
?>
