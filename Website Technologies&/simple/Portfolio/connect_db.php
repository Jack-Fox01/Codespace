<?php
$link = mysqli_connect('localhost', 'root', '', 'MKTime');

if (!$link) {
    die('Database connection failed: ' . mysqli_connect_error());
}
