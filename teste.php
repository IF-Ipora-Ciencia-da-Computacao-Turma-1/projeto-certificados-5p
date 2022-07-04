<?php
  include('PHP/connection.php');
  
  $token_cookie = $_COOKIE['token'];
    if(isset($token_cookie)){
      echo"Bem-Vindo, $token_cookie <br>";
      echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você";
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
      echo"<br><a href='login.html'>Faça Login</a> Para ler o conteúdo";
    }
    header("Location:certificado.html");
?>