<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? $title : "الرئيسية" ?></title>
    <script src="../js/jquery.js"></script>
    <!--  date time picker scripts  -->
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>

    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="item"> جامعة السودان المفتوحة - كلية علوم الحاسوب</div>
            <div class="item"><img src="../image/sudan.png" alt="" srcset=""></div>
        </div>
    </div>