<?php
include "inc/database.php";
include "function/function.php";
?>
<div class="container">
    <div class="nav">
        <table>
            <tr>
                <td><a href="index.php">الرئيسية</a></td>
                <td><a href="about.html">عن الموقع</a></td>
                <td style="border: 1px solid #555">
                    <?php
                    if (!isset($_SESSION['fullname'])) { ?>
                        <a href="login.php">تسجيل الدخول</a>
                    <?php } else { ?>
                        <a href="logout.php">تسجيل الخروج</a>
                    <?php } ?>
                </td>
                <td>
                    <div class="dropdown <?= isset($_SESSION['type']) && $_SESSION['type'] != 1 || $_SESSION['type'] = null ?  'admin' :  '' ?>">
                        <button class="dropbtn">عمليات المسجل</button>
                        <div class="dropdown-content">
                            <a href=" sinup.php">تسجيل جديد</a>
                            <a href=" subject.php"> اضافة مادة</a>
                            <a href=" section.php"> اضافة قسم</a>
                            <a href=" teacher.php"> اضافة استاذ</a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>