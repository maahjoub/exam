<?php
$title = " تسجيل الدخول";
if (isset($_SESSION["student"])) {
    header('location: index.php');
} else {
    include_once "inc/database.php";
    include_once "inc/header.php";
    include_once "function/function.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashPass = sha1($password);
        $errors = [];
        if (empty($password)) {
            $errors['password'] = "حقل كلمة المرور مطلوب";
        }
        if (empty($email)) {
            $errors['email'] = "حقل الايميل مطلوب";
        }
        if (empty($errors)) {
            $stmt = $coon->prepare("SELECT * FROM student where email=? AND password=?");
            $stmt->execute(array($email, $hashPass));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $_SESSION['userID'] = $row['id'];
                $_SESSION['fullname'] = $row['name'];
                $_SESSION['type'] = $row['type'];
                $stdNum = first($coon, "stdnum", $row['id'], 'std_id');
                // $countStd = $stdNum->rowCount();
                if ($stdNum) {
                    header("location: index.php");
                    exit();
                }
                header("location: student-num.php");
                exit();
            } else {
                echo "<div class='alert-danger'> Sorry No Record In Database With Your Credintial  </div>";
            }
        }
    }
?>

    <div class="form">
        <form action="" method="post">
            <div class="input-grpup">
                <label for="">اسم المستخدم</label>
                <input type="text" name="email" placeholder="اكتب اسم المستخدم">
            </div>
            <?= isset($errors['email']) ? "<div class='alert-danger'>" . $errors['email'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for=""> كلمة المرور</label>
                <input type="password" name="password" placeholder="اكتب كلمة المرور">
            </div>
            <?= isset($errors['password']) ? "<div class='alert-danger'>" . $errors['password'] . "</div>" : '' ?>
            <div class="submit">
                <button type="submit"> الدخول</button>
            </div>
        </form>
    </div>

<?php
    include_once "inc/footer.php";
}
?>