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

$sections = selectAll($coon, "section");
$countreis = selectAll($coon, "country");


?>

<div class="container">
    <div class="form">
        <form action="" method="post">
            <div class="input-grpup">
                <label for="">الاسم </label>
                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="اكتب اسم المستخدم">
            </div>

            <div class="input-grpup">
                <label for="">الدرجة العلمية </label>
                <input type="text" name="level" value="<?= isset($_POST['level']) ? $_POST['level'] : '' ?>" placeholder="اكتب   الشهادة التعليمية   ">
            </div>
            <div class="input-grpup">
                <label for="">الشهادة التعليمية </label>
                <input type="text" name="degree" value="<?= isset($_POST['degree']) ? $_POST['degree'] : '' ?>" placeholder="اكتب الشهادة التعليمية   ">
            </div>
            <div class="input-grpup">
                <label for=""> تاريخ بدء العمل </label>
                <input type="text" id="datepicker" name="start-date" placeholder="تاريخ بدء العمل">
            </div>

            <div class="input-grpup">
                <label for=""> التخصص </label>
                <input type="text" name="specialize" value="<?= isset($_POST['specialize']) ? $_POST['specialize'] : '' ?>" placeholder=" اكتب التخصص ">
            </div>

            <div class="input-grpup">
                <span></span>
                <select name="section" <?= isset($_POST['section']) ? $_POST['section'] : '' ?> id="">
                    <option value="">القسم</option>
                    <?php foreach ($sections as $section) : ?>
                        <option value="<?= $section['id'] ?>"><?= $section['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="input-grpup">
                <label for=""> جهة العمل </label>
                <input type="text" name="work" value="<?= isset($_POST['work']) ? $_POST['work'] : '' ?>" placeholder="اكتب جهة العمل  ">
            </div>
            <div class="submit">
                <button type="submit">موافق </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>