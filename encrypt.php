
<?php
function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'Semillero-Login';
    $secret_iv = '1.0';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - El método de cifrado AES-256-CBC espera 16 bytes; de lo contrario, recibirá una advertencia
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
 ?>
