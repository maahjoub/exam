<?php
$title = "اضافة مادة ";
include_once "inc/database.php";
include_once "inc/header.php";
include_once "inc/navbar.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $section = $_POST['section'];
    $teacher = $_POST['teacher'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "حقل الاسم المادة مطلوب";
    }
    if (empty($section)) {
        $errors['section'] = "حقل الاسم القسم مطلوب";
    }
    if (empty($teacher)) {
        $errors['teacher'] = "حقل الاسم القسم مطلوب";
    }

    if (empty($errors)) {
        $stmt = $coon->prepare("INSERT INTO subjects (name, section_id, teacher_id) 
                        VALUES (?, ?, ?)");
        $stmt->execute([$name, $section, $teacher]);
        if ($stmt->rowCount() > 0) {
            header('location: subject.php');
            exit();
        }
    }
}
$countreis = selectAll($coon, "section");
$teachers = selectAll($coon, "teacher");
?>

<div class="container">
    <div class="form">
        <form action="" method="post">
            <div class="input-grpup">
                <label for="">الاسم المادة </label>
                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="اكتب اسم المادة">
            </div>
            <?= isset($errors['name']) ? "<div class='alert-danger'>" . $errors['name'] . "</div>" : '' ?>
            <div class="input-grpup">
                <span></span>
                <select name="section" id="">
                    <option value="">برجاء اختيار القسم</option>
                    <?php foreach ($countreis as $countryName) : ?>
                        <option value="<?= $countryName['id'] ?>"><?= $countryName['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= isset($errors['section']) ? "<div class='alert-danger'>" . $errors['section'] . "</div>" : '' ?>

            <div class="input-grpup">
                <span></span>
                <select name="teacher" id="">
                    <option value="">برجاء اختيار الاستاذ</option>
                    <?php foreach ($teachers as $teacher) : ?>
                        <option value="<?= $teacher['id'] ?>"><?= $teacher['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= isset($errors['teacher']) ? "<div class='alert-danger'>" . $errors['teacher'] . "</div>" : '' ?>

            <div class="submit">
                <button type="submit">موافق </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>