<?php
session_start();
if(isset($_POST['title'])){
    require 'db_conn.php';
    $n = $_SESSION['username'];
    $title = $_POST['title'];
    $o = $_POST['oras'];
    $s = $_POST['strada'];
    $e = $_POST['email'];
    $t = $_POST['telefon'];
    if(empty($title)){
        header("Location: listadrese.php?mess=error");
    }else {
        $nr="INSERT INTO adrese(name,oras,strada,telefon,email,nume) VALUE(?,?,?,?,?,?)";
        $stmt = $conn->prepare($nr);
        $res = $stmt->execute([$title,$o,$s,$t,$e,$n]);
        if($res){
            header("Location:listadrese.php?mess=success");
        }else {
            header("Location:listadrese.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location:listadrese.php?mess=error");
}
