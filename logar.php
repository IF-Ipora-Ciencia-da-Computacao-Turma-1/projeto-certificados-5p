<?php
include('PHP/connection.php');
 
echo "O valor de CAMPO 1 é: " . $_POST["name"];
echo "<br>O valor de CAMPO 2 é: " . $_POST["pass"];
$name =  $_POST["name"];
$pass = hash('sha256', $_POST["pass"]);
echo "<br>".$pass."<br>";

$sql = "SELECT valida_usuario('$name', '$pass') as Validou";
$result = mysqli_query($connection, $sql);

$sql2 = "SELECT * FROM user";


$r = mysqli_query($connection,$sql2);
    while($fetch = mysqli_fetch_row($r)){
        echo "<p>". $fetch[0] . " - " . $fetch[1] . " - " . $fetch[2] . "</p>";
    }

$SQL3 ="SELECT * FROM user WHERE username = '$name'";
$result_id = mysqli_query($connection,$SQL3);
$total = mysqli_num_rows($result_id);
    if($total)  {
        $dados = mysqli_fetch_array($result_id);
        if(!strcmp(md5($pass), $dados["password"])) {
            echo "O login fornecido está correto";

            if ($dados["token"]=="") {
                $t=token($dados);
                $id = $dados["id"];
                $sql_update = "UPDATE user SET token='$t' WHERE id='$id'";
                $result = mysqli_query($connection,$sql_update);
                setcookie("token",$t);
                header("Location:teste.php");
            }
            setcookie("token",$dados["token"]);
            header("Location:teste.php");
           
        } else {
            echo "Senha inválida!";
            incorreto();
        exit;
        }
    } else {
        echo "O login fornecido por você é inexistente!";
        incorreto();
        exit;
    }


    function base64ErlEncode($data) {
        return str_replace(['+','/','='],['-','_',''], base64_encode($data));
    }

    function token($dados) {
        $key = 'secret';

    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    $header = json_encode($header);
    $header = base64ErlEncode($header);

    $payload = [
        'username' => $dados["username"],
        'sub' => $dados["id"],
    ];
    $payload = json_encode($payload);
    $payload = base64ErlEncode($payload);

    $signature = hash_hmac('sha256', " {$header}.{$payload}", $key, true);
    $signature = base64ErlEncode($signature);

    $token = "{$header}.{$payload}.{$signature}";
    return $token;
    }

    function incorreto(){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='login.html';</script>";
        die();
    }
?>