<?php

    $connect = mysqli_connect('localhost', 'root', '', 'users');

    if (!$connect) {
        die('Error connect to DataBase');
    }