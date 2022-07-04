<?php

    function base64ErlEncode($data) {
        return str_replace(['+','/','='],['-','_',''], base64_encode($data));
    }

    $key = 'secret';

    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    $header = json_encode($header);
    $header = base64ErlEncode($header);

    $payload = [
        'username' => 'douglascabral',
        'email' => 'contato@douglascabral.com.br'
    ];
    $payload = json_encode($payload);
    $payload = base64ErlEncode($payload);

    $signature = hash_hmac('sha256', " {$header}.{$payload}", $key, true);
    $signature = base64ErlEncode($signature);

    $token = "{$header}.{$payload}.{$signature}";

    echo $token;