<?php
session_start();
session_destroy();
if (isset($_SESSION["loggedIn"])) {
    header("Location: login.php");
    exit();
}
