<?php 

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "dbparkir_nurlianasani"
);

//cek
if(!$conn){
    die("connection is fail" . mysqli_connect_error());
}