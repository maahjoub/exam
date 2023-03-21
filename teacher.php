<?php
$title  =  "تسجيل مستخدم جديد ";
include_once "inc/database.php";
include_once "inc/header.php";
include_once "function/function.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $level = $_POST['level'];
    $degree = $_POST['degree'];
    $startDate = $_POST['startDate'];
    dd( str_replace('/', '-', $startDate));
    $specialize = $_POST['specialize'];
    $section =  $_POST['section'];
    $work =  $_POST['work'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "حقل الاسم مطلوب";
    }
    if (empty($level)) {
        $errors['level'] = "حقل الدرجة العلمية مطلوب";
    }
    if (empty($degree)) {
        $errors['degree'] = "حقل الشهادة مطلوب";
    }
    if (empty($startDate)) {
        $errors['startDate'] = "حقل تاريخ البدء مطلوب";
    }
    if (empty($specialize)) {
        $errors['specialize'] = "حقل التخصص مطلوب";
    }
    if (empty($section)) {
        $errors['section'] = "هذا الحقل مطلوب";
    }
    if (empty($work)) {
        $errors['work'] = "هذا الحقل مطلوب";
    }
    if (empty($errors)) {
        $stmt = $coon->prepare("INSERT INTO teacher (`name`, `level`, `dgree`, `start-date` , `specialize`, `section_id`, `word`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $level, $degree, $startDate, $specialize, $section, $work]);
        dd($stmt);
        if ($stmt->rowCount() > 0) {
            $id = $coon->lastinsertId();
            $teacher = first($coon, "teacher", $id, "id");
            header('location: teacher.php?teacher=' . $teacher);
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
            <?= isset($errors['name']) ? "<div class='alert-danger'>" . $errors['name'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for="">الدرجة العلمية </label>
                <input type="text" name="level" value="<?= isset($_POST['level']) ? $_POST['level'] : '' ?>" placeholder="اكتب   الشهادة التعليمية   ">
            </div>
            <?= isset($errors['level']) ? "<div class='alert-danger'>" . $errors['level'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for="">الشهادة التعليمية </label>
                <input type="text" name="degree" value="<?= isset($_POST['degree']) ? $_POST['degree'] : '' ?>" placeholder="اكتب الشهادة التعليمية   ">
            </div>
            <?= isset($errors['degree']) ? "<div class='alert-danger'>" . $errors['degree'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for=""> تاريخ بدء العمل </label>
                <input type="text" id="datepicker" name="startDate" placeholder="تاريخ بدء العمل">
            </div>
            <?= isset($errors['startDate']) ? "<div class='alert-danger'>" . $errors['startDate'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for=""> التخصص </label>
                <input type="text" name="specialize" value="<?= isset($_POST['specialize']) ? $_POST['specialize'] : '' ?>" placeholder=" اكتب التخصص ">
            </div>
            <?= isset($errors['specialize']) ? "<div class='alert-danger'>" . $errors['specialize'] . "</div>" : '' ?>
            <div class="input-grpup">
                <span></span>
                <select name="section" <?= isset($_POST['section']) ? $_POST['section'] : '' ?> id="">
                    <option value="">القسم</option>
                    <?php foreach ($sections as $section) : ?>
                        <option value="<?= $section['id'] ?>"><?= $section['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= isset($errors['section']) ? "<div class='alert-danger'>" . $errors['section'] . "</div>" : '' ?>
            <div class="input-grpup">
                <label for=""> جهة العمل </label>
                <input type="text" name="work" value="<?= isset($_POST['work']) ? $_POST['work'] : '' ?>" placeholder="اكتب جهة العمل  ">
            </div>
            <?= isset($errors['work']) ? "<div class='alert-danger'>" . $errors['work'] . "</div>" : '' ?>
            <div class="submit">
                <button type="submit">موافق </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>