<?php
session_start();
if(isset($_POST['title'])){
    require 'db_conn.php';
    $n = $_SESSION['username'];
    $title = $_POST['title'];

    if(empty($title)){
        header("Location: listatodo.php?mess=error");
    }else {
        $nr="INSERT INTO todos(title,nume) VALUE(?,?)";
        $stmt = $conn->prepare($nr);
        $res = $stmt->execute([$title,$n]);
        if($res){
            header("Location:listatodo.php?mess=success"); 
        }else {
            header("Location:listatodo.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location:listatodo.php?mess=error");
}