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
  Table used by Day 14 for login (create once in phpMyAdmin):

  USE students_management;

  CREATE TABLE IF NOT EXISTS users (
      id       INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50)  NOT NULL UNIQUE,
      email    VARCHAR(100) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL
  );

  Note: passwords are stored as a secure hash via password_hash(),
  so the value in the "password" column will look scrambled - that is correct.
*/
?>
