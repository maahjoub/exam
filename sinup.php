<?php
$title  =  "تسجيل مستخدم جديد ";
include_once "inc/database.php";
include_once "inc/header.php";
include_once "function/function.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['fullName'];
    $genders = $_POST['gender'];
    $countery = $_POST['countery'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashPass = sha1($password);
    $type =  $_POST['type'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "حقل الاسم مطلوب";
    }
    if (empty($genders)) {
        $errors['gender'] = "حقل النوع مطلوب";
    }
    if (empty($countery)) {
        $errors['countery'] = "حقل البلد مطلوب";
    }
    if (empty($password)) {
        $errors['password'] = "حقل كلمة المرور مطلوب";
    }
    if (empty($email)) {
        $errors['email'] = "حقل الايميل مطلوب";
    }
    if (empty($type)) {
        $errors['type'] = "هذا الحقل مطلوب";
    }
    if (empty($errors)) {
        $stmt = $coon->prepare("INSERT INTO student (name, gender_id, country_id, email, password, type) 
                        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $genders, $countery, $email, $hashPass, $type]);
        if ($stmt->rowCount() > 0) {
            header('location: login.php');
            exit();
        } else {
        }
    }
}

$genders = selectAll($coon, "gender");
$countreis = selectAll($coon, "country");


?>

<div class="container">
    <div class="form">
        <form action="" method="post">
            <div class="input-grpup">
                <label for="">الاسم رباعي </label>
                <input type="text" name="fullName" value="<?= isset($_POST['fullName']) ? $_POST['fullName'] : '' ?>" placeholder="اكتب اسم المستخدم">
            </div>
            <?= isset($errors['name']) ? "<div class='alert-danger'>" . $errors['name'] . "</div>" : '' ?>
            <div class="input-grpup">
                <span></span>
                <select name="gender" <?= isset($_POST['gender']) ? $_POST['gender'] : '' ?> id="">
                    <option value="">النوع</option>
                    <?php foreach ($genders as $genderName) : ?>
                        <option value="<?= $genderName['id'] ?>"><?= $genderName['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= isset($errors['gender']) ? "<div class='alert-danger'>" . $errors['gender'] . "</div>" : '' ?>
            <div class="input-grpup">
                <span></span>
                <select name="countery" id="">
                    <option value="">الدولة</option>
                    <?php foreach ($countreis as $countryName) : ?>
                        <option value="<?= $countryName['id'] ?>"><?= $countryName['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= isset($errors['countery']) ? "<div class='alert-danger'>" . $errors['countery'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for=""> البريد الالكتروني</label>
                <input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="اكتب البريد الالكتروني">
            </div>
            <?= isset($errors['email']) ? "<div class='alert-danger'>" . $errors['email'] . "</div>" : '' ?>

            <div class="input-grpup">
                <label for=""> كلمة المرور</label>
                <input type="password" name="password" placeholder="اكتب كلمة المرور">
            </div>
            <?= isset($errors['password']) ? "<div class='alert-danger'>" . $errors['password'] . "</div>" : '' ?>
            <div class="input-grpup">
                <span></span>
                <select name="type" id="">
                    <option value="">نوع المستخدم</option>
                    <option value="0">مدير</option>
                    <option value="1">مسجل</option>
                    <option value="2">طالب</option>
                    <option value="3">زائر</option>
                </select>
            </div>
            <?= isset($errors['type']) ? "<div class='alert-danger'>" . $errors['type'] . "</div>" : '' ?>
            <div class="submit">
                <button type="submit">موافق </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>