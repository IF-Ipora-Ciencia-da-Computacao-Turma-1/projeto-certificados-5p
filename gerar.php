<?php
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    date_default_timezone_set( 'America/Sao_Paulo' );
    require('fpdf2/fpdf.php');
    require('PHPMailer/class.phpmailer.php');

    //Variaveis da pagina
    $texto = utf8_decode($_POST['texto']);
    $email = $_POST['email'];
    $nome = utf8_decode($_POST['nome']);
    $cpf = utf8_decode($_POST['cpf']);

    if ($texto=="" or $email=="" or $nome=="" or $cpf=""){
        echo"<script language='javascript' type='text/javascript'>
        alert('Campos obrigatórios vazios, preencha-os para emitir certificado');window.location
        .href='certificado.html';</script>";
        die();
    }
<<<<<<< HEAD
    
=======

>>>>>>> 92f78f08f77f1fffcc439392bd8246d8ccf57bf6
    $empresa = "IF Goiano - Campus Iporá";
    $evento  = "VIII Encontro Anual de Tecnologia da Informação do Oeste Goiano – ENATI 2022";
    $data = "01 a 04 de junho de 2022";
    $carga_h = "20 horas";

    $texto1 = utf8_decode($empresa);
    $texto2 = utf8_decode($texto);
    $texto3 = utf8_decode("Iporá-GO, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));
    $data_hora = utf8_decode(utf8_encode(strftime( '%d-%m-%Y', strtotime( date( 'Y-m-d' ) ) )));
    $hora = date('H:i');

    $pdf = new FPDF();

    // Orientação Landing Page ///
    $pdf->AddPage('L');

    $pdf->SetLineWidth(1.5);


    // desenha a imagem do certificado
    $pdf->Image('certificado.jpeg',0,0,295);

    // Mostrar o nome
    $pdf->SetFont('Arial', '', 30); // Tipo de fonte e tamanho
    $pdf->SetXY(20,86); //Parte chata onde tem que ficar ajustando a posição X e Y
    $pdf->MultiCell(265, 10, $nome, '', 'C', 0); // Tamanho width e height e posição

    // Mostrar o corpo
    $pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
    $pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
    $pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição
    
    // Mostrar a data no final
    $pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
    $pdf->SetXY(32,172); //Parte chata onde tem que ficar ajustando a posição X e Y
    $pdf->MultiCell(165, 10, $texto3, '', 'L', 0); // Tamanho width e height e posição

    $certificado="arquivos/$cpf - $data_hora.pdf"; //atribui a variável $certificado com o caminho e o nome do arquivo que será salvo (vai usar o CPF digitado pelo usuário como nome de arquivo)
    $pdf->Output($certificado,'F'); //Salva o certificado no servidor (verifique se a pasta "arquivos" tem a permissão necessária)
    // Utilizando esse script provavelmente o certificado ficara salvo em www.seusite.com.br/gerar_certificado/arquivos/999.999.999-99.pdf (o 999 representa o CPF digitado pelo usuário)
    
    $pdf->Output(); // Mostrar o certificado na tela do navegador
?>