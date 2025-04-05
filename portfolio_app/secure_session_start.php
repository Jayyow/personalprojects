<?php 
    function startSecureSession(){
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict',
        ]);

        session_start();

        if(!isset($_SESSION['initialized'])){
            session_regenerate_id(true);
            $_SESSION['initialized'] = true;
        }
    }
?>