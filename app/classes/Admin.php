<?php
require_once '/Programas/xampp/htdocs/sistema-de-ponto/app/database/database.php';


class Admin
{
    
    private $pdo;

    public function __construct()
    {
        $database = new database();
        $this->pdo = $database->connect();
    }


    public function processaDados($dados)
    {
        try {

            if (isset($dados['nome'], $dados['turno'], $dados['tipo_funcionario'], $dados['email'], $dados['senha'], $dados['cpf'],$dados['matricula'], $dados['cargo'], $dados['data_nascimento'])) {

                $nome = $dados['nome'];
                $turno = $dados['turno'];
                $tipoFuncionario = $dados['tipo_funcionario'];
                $email = $dados['email'];
                $senha = $dados['senha'];
                $cpf = $dados['cpf'];
                $matricula = $dados['matricula'];
                $cargo = $dados['cargo'];
                $dataNascimento = $dados['data_nascimento'];

                $cadastro = $this->cadastrarFuncionario($nome, $turno, $tipoFuncionario, $email, $senha, $cpf, $matricula, $cargo, $dataNascimento);


                return json_encode($cadastro);
            }
        } catch (PDOException $e) {
            return json_encode("ERRO AO PROCESSAR DADOS" . $e->getMessage());
        }
    }

    public function cadastrarFuncionario($nome, $tipoFuncionario, $turno, $email, $senha, $cpf,$matricula, $cargo, $dataNascimento)
    {

        try {

            $sql = "INSERT INTO funcionarios (id_tipo, id_turno, nome, email, senha, cpf, matricula, cargo, data_nascimento, data_admissao) VALUES(:tipo_funcionario,:turno, :nome ,:email, :senha, :cpf,:matricula, :cargo, :data_nascimento, now())";

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':tipo_funcionario', $tipoFuncionario);
            $statement->bindParam(':turno', $turno);
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':senha', $senhaHash);
            $statement->bindParam(':cpf', $cpf);
            $statement->bindParam(':matricula', $matricula);
            $statement->bindParam(':cargo', $cargo);
            $statement->bindParam(':data_nascimento', $dataNascimento);
            $statement->execute();

            $arrayRetorno['code'] = 200;
            $arrayRetorno['mensagem'] = "Funcionário cadastrado com sucesso!";


            return json_encode($arrayRetorno);
        } catch (PDOException $e) {
            return json_encode("ERRO AO CADASTRAR FUCNIONÁRIO: " . $e->getMessage());
        }
    }

    public function atualizarFuncionario(){

    }

    public function listarUsuarios()
    {
        $sql = "SELECT * FROM funcionarios";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $funcionarios = $statement->fetchAll();
        return $funcionarios;
    }
}

$admin = new Admin();
if (isset($_POST['nome'], $_POST['turno'], $_POST['tipo_funcionario'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['matricula'], $_POST['cargo'], $_POST['data_nascimento'])) {
    $cadastro = $admin->cadastrarFuncionario(
        $_POST['nome'],
        $_POST['turno'],
        $_POST['tipo_funcionario'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['cpf'],
        $_POST['matricula'],
        $_POST['cargo'],
        $_POST['data_nascimento']
    );

    echo $cadastro;

}
