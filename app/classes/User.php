<?php

session_start();
require_once '/xampp/htdocs/sistema-de-ponto/app/database/database.php';

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

            $sql = "SELECT * FROM funcionarios WHERE email = :email AND senha = :senha";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":email", $login);
            $statement->bindValue(":senha", $senha);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                $data = $statement->fetch(PDO::FETCH_ASSOC);

                $_SESSION['funcionario'] = $data;

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return json_encode(['error' => 'Erro ao fazer login: ' . $e->getMessage()]);
        }
    }

    public function baterPonto($id_funcionario)
    {

        date_default_timezone_set("America/Sao_Paulo");

        $dateTime = new DateTime();
        $arrayRetorno['data'] = $dateTime->format("d/m/Y H:i");
        $dateFormat = $dateTime->format("Y-m-d H:i:s");
        $exibeMarcacao = json_decode($this->exibeMarcacao($id_funcionario));
        
        if ($exibeMarcacao !== null) {
            $ultimoPonto =  new DateTime($exibeMarcacao);
            $intervalo = $dateTime->diff($ultimoPonto);
            if ($intervalo->format('%H:%I:%S') < "00:00:10") {
                $arrayRetorno['mensagem'] = "Por favor aguardar antes de bater outro ponto!";
                return json_encode($arrayRetorno);
            }
        }

        try {

            $tipoMarcacao = $this->determinaTipoMarcacao($id_funcionario, $arrayRetorno['data']);
            

            $sql = "INSERT INTO pontos (id_funcionario, ponto, ponto_tipo) VALUES(:id_funcionario, :ponto, :tipo_ponto)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_funcionario", $id_funcionario);
            $statement->bindParam(":ponto", $dateFormat);
            $statement->bindParam(":tipo_ponto", $tipoMarcacao);
            $statement->execute();

            $arrayRetorno['code'] = 200;
            $arrayRetorno['mensagem'] = 'Ponto batido com sucesso';

            return json_encode($arrayRetorno);
        } catch (PDOException $e) {
            return json_encode('Erro ao bater ponto' . $e->getMessage());
        }
    }


    public function determinaTipoMarcacao($id_funcionario, $dateTime)
    {

        try {
            $sql = "SELECT COUNT(*) as quantidade_pontos
                FROM pontos
                WHERE id_funcionario = :id_funcionario and "
                ;

            
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id_funcionario", $id_funcionario);
            $statement->execute();
            $quantidadeDePontos = $statement->fetchColumn();
            echo $quantidadeDePontos;
            exit();
            if ($quantidadeDePontos === 1) {
                $arrayRetorno['tipo_ponto'] = "E";
                return $arrayRetorno;
            } else if ($quantidadeDePontos === 2) {
                $arrayRetorno['tipo_ponto'] = "S";
                return $arrayRetorno;
            }
        } catch (PDOException $e) {
            return 'Erro ao determinar tipo do ponto' . $e->getMessage();
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
}

$objUser = new User;

if (isset($_POST['id_funcionario'])) echo $objUser->baterPonto($_POST['id_funcionario']);

if (isset($_GET['ultima_marcacao'])) echo $objUser->exibeMarcacao($_GET['ultima_marcacao']);
