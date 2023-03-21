<?php
include "inc/database.php";
function selectAll($connection, $table)
{
    $query = $connection->prepare("SELECT * FROM $table");
    $query->execute();
    $stmt = $query->fetchAll();
    return $stmt;
}
function first($connection, $table, $bind, $where)
{
    $query = $connection->prepare("SELECT * FROM $table where $where=?");
    $query->execute(array($bind));
    $row = $query->fetch();
    //$count = $row->rowCount();
    return $row;
}
function dd($var)
{
    return print_r($var);
    exit();
}
