<?php
session_start();

if (isset($_SESSION['email'])) {
    echo 'valid';
} else {
    echo 'invalid';
}
?>
