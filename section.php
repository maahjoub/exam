<?php
$title = "اضافة قسم ";
include_once "inc/database.php";
include_once "inc/header.php";
include_once "inc/navbar.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "حقل الاسم القسم مطلوب";
    }

    if (empty($errors)) {
        $stmt = $coon->prepare("INSERT INTO section (name) 
                        VALUES (?)");
        $stmt->execute([$name]);
        if ($stmt->rowCount() > 0) {
            header('location: section.php');
            exit();
        }
    }
}
?>
<div class="container">
    <div class="form">
        <form action="" method="post">
            <div class="input-grpup">
                <label for=""> اسم القسم </label>
                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="اكتب اسم القسم">
            </div>
            <?= isset($errors['name']) ? "<div class='alert-danger'>" . $errors['name'] . "</div>" : '' ?>
            <div class="submit">
                <button type="submit">موافق </button>
            </div>
        </form>
    </div>
</div>
<?php
include_once "inc/footer.php";
?>