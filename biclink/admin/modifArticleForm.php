<?php
require_once __DIR__ . '/require_login.php';
header("Content-Type: text/html; charset=utf-8");

// SQL INJECTION FIX: the original built the query as
//   "SELECT * FROM `article` where idA=" . $_GET['id']
// so a URL like modifArticleForm.php?id=0 UNION SELECT ... could run
// arbitrary SQL. The id is now cast to an integer and bound as a parameter.
$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($link, "SELECT * FROM `article` WHERE idA = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html>
<style>
input[type=text], [type=date],[type=file] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>
 <?php
                         if ($result && mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
                        ?>
<h3>Using CSS to style an HTML Form</h3>

<div>
  <form action="modifAritcleAction.php" method="post" enctype="multipart/form-data">
    <input type="hidden" id="fname" name="id" value="<?php echo e($row["idA"]);?>" required>
    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token());?>">

    <label for="fname">Titre</label>
    <input type="text" id="fname" name="titre" value="<?php echo e($row["titreA"]);?>" required>

    <label for="lname">Auteur</label>
    <input type="text" id="lname" name="auteur" value="<?php echo e($row["auteur"]);?>" required>

    <label for="lname">Texte</label>
    <input type="text" id="lname" name="texte" value="<?php echo e($row["texte"]);?>" required>

    <label for="lname">Date</label>
    <input type="date" id="lname" name="date" value="<?php echo e($row["date"]);?>" required>

    <br>
    <label for="lname">Image</label>
    <input type="file" name="file"  value="<?php echo e($row["image"]);?>" required >
    
  
    <input type="submit" value="Submit">
  </form>
<?php } } ?>
</div>

</body>
</html>
