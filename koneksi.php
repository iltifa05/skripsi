<?php
set_time_limit(0);

session_start();

date_default_timezone_set('Asia/Makassar');

$server = "localhost";
$username = "root";
$password = "";
$database = "db_monitoringevaluasiskrpsi";

$conn = mysqli_connect($server, $username, $password, $database);

include 'proses/function.php';

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$baseURL = 'http://'.$_SERVER['HTTP_HOST'].'/'.$uri_segments[1];

$directoryURI = $_SERVER['REQUEST_URI'];
$parseURI = parse_url($directoryURI, PHP_URL_PATH);
$componentsURI = explode('/', $parseURI);
$pathURI = $componentsURI[2];
?>