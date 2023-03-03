<?php

// database
include './db.php';

// destroy and unset session
$_SESSION = [];
session_unset();
session_destroy();
header('Location: ./login.php');