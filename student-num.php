<?php
$title = " تسجيل الدخول";
if (isset($_SESSION["student"])) {
    header('location: index.php');
} else {
    $title = "الرقم الجامعي ";
    include_once "inc/database.php";
    include_once "inc/header.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $stdNum = $_POST['stdnum'];
        $id = $_SESSION['userID'];
        $errors = [];
        if (empty($stdNum)) {
            $errors['stdnum'] = "عليك ادخال الرقم الجامعي ";
        }
        if (empty($errors)) {
            $stmt = $coon->prepare("INSERT INTO stdNum (std_num, std_id) 
                        VALUES (?, ?)");
            $stmt->execute([$stdNum, $id]);
            if ($stmt->rowCount() > 0) {
                header('location: index.php');
                exit();
            }
        }
    }

?>

    <div class="container">
        <div class="form">

            <form action="" method="post">
                <div class="input-grpup">
                    <label for=""> الرقم الجامعي </label>
                    <input type="text" name="stdnum" value="<?= isset($_POST['stdnum']) ? $_POST['stdnum'] : '' ?>" placeholder="اكتب  الرقم الجامعي">
                </div>
                <?= isset($errors['stdnum']) ? "<div class='alert-danger'>" . $errors['stdnum'] . "</div>" : '' ?>
                <div class="submit">
                    <button type="submit">موافق </button>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once "inc/footer.php";
}
?>