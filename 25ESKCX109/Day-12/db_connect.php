<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "students_management";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*
  Run this SQL once in phpMyAdmin to create the table used by Day 12:

  CREATE DATABASE IF NOT EXISTS students_management;
  USE students_management;

  CREATE TABLE IF NOT EXISTS students (
      id       INT AUTO_INCREMENT PRIMARY KEY,
      name     VARCHAR(100) NOT NULL,
      email    VARCHAR(100) NOT NULL UNIQUE,
      roll     VARCHAR(50)  NOT NULL,
      mobile   VARCHAR(15)  NOT NULL,
      branch   VARCHAR(50)  NOT NULL
  );
*/
?>
