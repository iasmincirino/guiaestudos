CREATE DATABASE matriculas;
USE matriculas;

-- Tabela dos alunos
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Id
    nome_aluno VARCHAR(255) NOT NULL,        -- Nome do aluno
    cpf VARCHAR(14) NOT NULL UNIQUE,           -- CPF do aluno
    serie VARCHAR(100) NOT NULL,   -- Série ou ano escolar
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data de registro da matrícula
);

-- Tabela dos responsáveis
CREATE TABLE responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Id
    responsavel VARCHAR(255) NOT NULL,        -- Nome do responsável
    contato VARCHAR(15) NOT NULL,      -- Contato
    relacao VARCHAR(50) NOT NULL,         -- Relação com o aluno (ex.: pai, mãe, tutor)
    aluno_id INT,                              -- Chave estrangeira para associar o responsável ao aluno
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) -- Relacionamento com a tabela de alunos
);
