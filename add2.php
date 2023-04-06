<?php
session_start();
if(isset($_POST['ora'])){
    require 'db_conn.php';
    $n = $_SESSION['username'];
    $ora = $_POST['ora'];
    $locatie = $_POST['locatie'];
    $descriere = $_POST['descriere'];
    $zi = $_POST['zi'];
    if(empty($ora)){
        header("Location: listaintalniri.php?mess=error");
    }else {
        $nr="INSERT INTO intalniri(zi,ora,locatie,descriere,nume) VALUE(?,?,?,?,?)";
        $stmt = $conn->prepare($nr);
        $res = $stmt->execute([$zi,$ora,$locatie,$descriere,$n]);
        if($res){
            header("Location:listaintalniri.php?mess=success");
        }else {
            header("Location:listaintalniri.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location:listaintalniri.php?mess=error");
}
