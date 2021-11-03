<?php

session_start();

$id = 0;
$update = false;
$user = 'root';
$pass = '';
$db = 'crudphpp';

$db = new mysqli('localhost', $user, $pass, $db) or die(mysqli_error($mysqli));

$nome = '';
$descricao = '';
$quantidade = '';
$pu = '';
$um = '';

if (isset($_POST['registrar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $pu = $_POST['pu'];
    $um = $_POST['um'];

    $db->query("INSERT INTO produto (nome, descricao, quantidade, pu, um) VALUES('$nome', '$descricao', '$quantidade', '$pu', '$um')") or die($mysqli->error());

    $_SESSION['message'] = "Produto registrado com sucesso!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $db->query("DELETE FROM produto WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Produto removido com sucesso!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $db->query("SELECT * FROM produto WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $descricao = $row['descricao'];
        $quantidade = $row['quantidade'];
        $pu = $row['pu'];
        $um = $row['um'];

    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $pu = $_POST['pu'];
    $um = $_POST['um'];

    $db->query("UPDATE produto SET nome='$nome', descricao='$descricao', quantidade='$quantidade', pu='$pu', um='$um' WHERE id=$id") or 
        die($mysql->error());

    $_SESSION['message'] = "Produto atualizado com sucesso!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
?>