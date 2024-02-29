<?php
    session_start();

    print_r($_COOKIE);
    print_r($_SESSION);
    
    $_COOKIE['domainsID']+=99;
    $_SESSION['domainsID']+=89;

    print_r($_COOKIE);
    print_r($_SESSION);

    
?>