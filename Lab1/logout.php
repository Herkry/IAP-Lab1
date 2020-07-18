<?php
    include_once "user.php";
    $user = new User("anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous");
    $user->logout();
?>