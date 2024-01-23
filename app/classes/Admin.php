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

            if (isset($dados['nome'], $dados['turno'], $dados['tipo_funcionario'], $dados['email'], $dados['senha'], $dados['cpf'], $dados['matricula'], $dados['cargo'], $dados['data_nascimento'])) {

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

    public function cadastrarFuncionario($nome, $tipoFuncionario, $turno, $email, $senha, $cpf, $matricula, $cargo, $dataNascimento)
    {

        try {

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO funcionarios (id_tipo, id_turno, nome, email, senha, cpf, matricula, cargo, data_nascimento, data_admissao, funcionario_status) VALUES(:tipo_funcionario,:turno, :nome ,:email, :senha, :cpf,:matricula, :cargo, :data_nascimento, now(), '1')";

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

    public function editarFuncionario(array $dados, $idFuncionario)
    {
        try {
            $sql = "UPDATE funcionarios 
                    SET nome = '". $dados['nome'] ."',
                    id_turno = '". $dados['id_turno'] ."',
                    id_tipo = '". $dados['id_tipo'] ."',
                    email = '". $dados['email'] ."',";
                    if (isset($dados['senha'])) {
                        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
                        $sql .= "senha = '". $dados['senha'] ."',";
                    }  
                   $sql.= "cpf = '". $dados['cpf'] ."',
                    matricula = '". $dados['matricula'] ."',
                    cargo = '". $dados['cargo'] ."',
                    data_nascimento = '". $dados['data_nascimento'] ."'
                    WHERE id = '". $idFuncionario. "'
                    ";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $arrayRetorno['code'] = 200;
            $arrayRetorno['mensagem'] = "Funcionário editado com sucesso!";

            return json_encode($arrayRetorno);
        } catch (PDOException $e) {
            return json_encode("ERRO AO EDITAR FUNCIONÁRIO: " . $e->getMessage());
        }
    }




    public function alteraStatus($idFuncionario, $status)
    {
        try {
            if ($status == 1) {
                $sql = "UPDATE funcionarios SET funcionario_status = '0' WHERE id= :id_funcionario";
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(":id_funcionario", $idFuncionario);
                $statement->execute();
                $arrayRetorno['code'] = 200;
                $arrayRetorno['mensagem'] = "Funcionário inativado com sucesso";
                return json_encode($arrayRetorno);
            } elseif ($status == 0) {
                $sql = "UPDATE funcionarios SET funcionario_status = '1' WHERE id= :id_funcionario";
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(":id_funcionario", $idFuncionario);
                $statement->execute();
                $arrayRetorno['code'] = 200;
                $arrayRetorno['mensagem'] = "Funcionário ativado com sucesso";
                return json_encode($arrayRetorno);
            }
        } catch (\Throwable $e) {
            return json_encode("ERRO AO ALTERAR STATUS DO FUCNIONÁRIO: " . $e->getMessage());
        }
    }

    public function listarUsuarios($id = null)
    {
        try {
            if ($id === null || $id === '') {
                $sql = "SELECT * FROM funcionarios";
    
                $statement = $this->pdo->prepare($sql);
                $statement->execute();
                $funcionarios = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $funcionarios;
            } else {
                $sql = "SELECT * FROM funcionarios WHERE id = :id";
    
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(":id", $id);
                $statement->execute();
                $funcionarios = $statement->fetch(PDO::FETCH_ASSOC);
                return $funcionarios;
            }
        } catch (PDOException $e) {
            return "ERRO AO ALTERAR STATUS DO FUCNIONÁRIO: " . $e->getMessage();
        }
    }

    public function listarPontos($nome = null){
        try {
            if($nome === null || $nome === ""){
            $sql = "SELECT nome, email, cpf, matricula, cargo, data_nascimento, data_admissao, ponto, ponto_tipo, latitude,longitude
            from pontos
            inner join sistema_de_ponto.funcionarios f on pontos.id_funcionario = f.id
        ";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        if($statement->rowCount() > 0){
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        else{
            return false;
        }
    }
    else{
        $sql = "SELECT nome, email, cpf, matricula, cargo, data_nascimento, data_admissao, ponto, ponto_tipo, latitude,longitude
        from pontos
        inner join sistema_de_ponto.funcionarios f on pontos.id_funcionario = f.id
        where nome = :nome";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":nome", $nome);
        if($statement -> rowCount() > 0){
           $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        else{
            return false;
        }
    }
        } catch (PDOException $e) {
            return "ERRO AO LISTAR PONTOS DA TABLEA: ". $e->getMessage();
        }
    }

}

$admin = new Admin();
if (isset($_POST['id_funcionario'])) {
    $id_funcionario = $_POST['id_funcionario'];
    $nome = $_POST['nome'];
    $turno = $_POST['turno'];
    $tipo_funcionario = $_POST['tipo_funcionario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $matricula = $_POST['matricula'];
    $cargo = $_POST['cargo'];
    $data_nascimento = $_POST['data_nascimento'];

    $dados = [
        'nome' => $nome,
        'id_turno' => $turno,
        'id_tipo' => $tipo_funcionario,
        'email' => $email,
        'senha' => $senha,
        'cpf' => $cpf,
        'matricula' => $matricula,
        'cargo' => $cargo,
        'data_nascimento' => $data_nascimento
    ];

    $editarFuncionario = $admin->editarFuncionario($dados, $id_funcionario);
    echo $editarFuncionario;

} elseif (isset($_POST['nome'], $_POST['turno'], $_POST['tipo_funcionario'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['matricula'], $_POST['cargo'], $_POST['data_nascimento'])) {
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


if (isset($_POST['idFuncionario'], $_POST['status'])) {
    echo $admin->alteraStatus($_POST['idFuncionario'], $_POST['status']);
}

