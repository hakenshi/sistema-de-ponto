<?php

session_start();

require_once '/Programas/xampp/htdocs/sistema-de-ponto/app/database/database.php';

class User
{

    private $pdo;

    public function __construct()
    {
        $database = new database();
        $this->pdo = $database->connect();
    }

    public function login($login, $senha)
    {
        try {
            echo $senha . "<br>";
            $sql = "SELECT * FROM funcionarios WHERE email = :email";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":email", $login);
            $statement->execute();
            
            if ($statement->rowCount() > 0) {
                $data = $statement->fetch(PDO::FETCH_ASSOC);
                if(password_verify($senha, $data['senha'])){
                $_SESSION['funcionario'] = $data;

                return true;
            }
            else{
            return false;
            }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return json_encode(['error' => 'Erro ao fazer login: ' . $e->getMessage()]);
        }
    }

    public function baterPonto($id_funcionario, $latitude, $longitude)
    {

        date_default_timezone_set("America/Sao_Paulo");

        $dateTime = new DateTime();
        $arrayRetorno['data'] = $dateTime->format("d/m/Y H:i");
        $dateFormat = $dateTime->format("Y-m-d H:i:s");
        $exibeMarcacao = json_decode($this->exibeMarcacao($id_funcionario));

        if ($exibeMarcacao !== null) {
            $ultimoPonto =  new DateTime($exibeMarcacao);
            $intervalo = $dateTime->diff($ultimoPonto);
            if ($intervalo->format('%H:%I:%S') < "00:30:00") {
                $arrayRetorno['mensagem'] = "Por favor aguardar antes de bater outro ponto!";
                return json_encode($arrayRetorno);
            }
        }

        try {

            $tipoMarcacao = $this->determinaTipoMarcacao($id_funcionario);
            if ($_SESSION['funcionario']['funcionario_status'] == 0) {
                $arrayRetorno['code'] = 401;
                $arrayRetorno['mensagem'] = "Funcionário inativo";
                return json_encode($arrayRetorno);
            }

            $sql = "INSERT INTO pontos (id_funcionario, ponto, ponto_tipo,latitude,longitude) VALUES(:id_funcionario, :ponto, :tipo_ponto,:latitude,:longitude)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_funcionario", $id_funcionario);
            $statement->bindParam(":ponto", $dateFormat);
            $statement->bindParam(":tipo_ponto", $tipoMarcacao);
            $statement->bindParam(":latitude", $latitude);
            $statement->bindParam(":longitude", $longitude);
            $statement->execute();

            $arrayRetorno['code'] = 200;
            $arrayRetorno['mensagem'] = 'Ponto batido com sucesso';
            $arrayRetorno['tipoPonto'] = $tipoMarcacao;
            return json_encode($arrayRetorno);
        } catch (PDOException $e) {
            return json_encode('Erro ao bater ponto ' . $e->getMessage());
        }
    }


    public function determinaTipoMarcacao($id_funcionario)
    {

        $date = new DateTime();
        $dataIncial = $date->format("Y-m-d") . " 00:00:00";
        $dataFinal = $date->format("Y-m-d") . " 23:59:00";

        try {
            $sql = "SELECT COUNT(*) as quantidade_pontos
                FROM pontos
                WHERE  id_funcionario = :id_funcionario and ponto between '" . $dataIncial . "' and '" . $dataFinal . "'";

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_funcionario", $id_funcionario);
            $statement->execute();
            $quantidadeDePontos = $statement->fetchColumn();
            if ($quantidadeDePontos == 0) {
                return "E";
            } else if ($quantidadeDePontos > 0) {
                return "S";
            }
        } catch (PDOException $e) {
            return 'Erro ao determinar tipo do ponto ' . $e->getMessage();
        }

        return "N/A";
    }


    public function exibeMarcacao($id_funcionario)
    {
        try {
            $sql = "SELECT ponto
                    FROM pontos
                    WHERE id_funcionario = :id_funcionario
                    ORDER BY ponto DESC
                    LIMIT 1
                    ";

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_funcionario", $id_funcionario, PDO::PARAM_INT);
            $statement->execute();

            if ($statement->rowCount() >= 1) {
                $data = $statement->fetch(PDO::FETCH_ASSOC)['ponto'];
                return json_encode($data);
            } else {
                return json_encode(null);
            }
        } catch (PDOException $e) {
            return 'Erro ao exibir último ponto batido' . $e->getMessage();
        }
    }
    public function exibeTurnos($id = null)
    {
        if ($id === '' || $id === null) {
            $sql = "SELECT * FROM turnos";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $turnos = $statement->fetchAll();

            return $turnos;
        }
         else {
            $sql = "SELECT * FROM turnos WHERE id = :id_turno";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_turno", $id);
            $statement->execute();

            $turnos = $statement->fetch(PDO::FETCH_ASSOC);

            return $turnos;
        }
    }

    public function exibeTipoFuncionario()
    {
        $sql = "SELECT *
            FROM tipos_de_funcionario";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $tipoFuncionario = $statement->fetchAll();

        return $tipoFuncionario;
    }
    public function checkAdmin()
    {
        if ($_SESSION['funcionario']['id_tipo'] == 2) {
            return true;
        }
        return false;
    }

}


$objUser = new User;

if (isset($_POST['id_funcionario'], $_POST['latitude'], $_POST['longitude'])) echo $objUser->baterPonto($_POST['id_funcionario'], $_POST['latitude'], $_POST['longitude']);

if (isset($_GET['ultima_marcacao'])) echo $objUser->exibeMarcacao($_GET['ultima_marcacao']);
