<?php

// Teste da Unicred
// Chave de Autenticação - API Webhook: "f4aecbe7-5061-4522-a1d0-26fc74a920a0"
// Chave de Criptografia - API Webhook: "3410d803-bdb4-463a-bd5b-d46ddaaba37b"
$iv = 'f4aecbe7-5061-4522-a1d0-26fc74a920a0'; //16 primeiros caracteres
$iv16 = 'f4aecbe7-5061-45';
$key = '3410d803-bdb4-463a-bd5b-d46ddaaba37b';
// texto a ser decriptografado
// Após descriptografia deve apresentar o texto "Unicred via Webhook".
$encrypted = '9liYoy9rGzjnzN0VQDGIxHtUzM7+D+Tveu2MRZrSkxk=';
echo $encrypted;
echo '<br>';

// texto decriptografado 
$decrypted = openssl_decrypt($encrypted,'AES-256-CBC',$key,0,$iv16);
echo $decrypted;
echo '<br><br>';

// -----------------------------------------------------------------

// ColNotRS
// client id: 'f035f768-7394-49e0-abba-777a814a0136'
// client secret: '7573508f-1665-4bde-9917-97fa75497049'
$iv = 'f035f768-7394-49e0-abba-777a814a0136'; //16 primeiros caracteres
$iv16 = 'f035f768-7394-49';
$key = '7573508f-1665-4bde-9917-97fa75497049';
// texto criptografado com os dados do ColNotRS
$txt = 'Esse é um teste de desenvolvimento DeD/Odix';
$encrypted = openssl_encrypt($txt,'AES-256-CBC',$key,0,$iv16);
echo $encrypted;
echo '<br>';

// texto decriptografado 
$decrypted = openssl_decrypt($encrypted,'AES-256-CBC',$key,0,$iv16);
echo $decrypted;
?>