<?php
require_once __DIR__ . '/require_login.php';
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<a href="updatepage.php"> <h1>affichage des articles</h1></a>
<table id="customers">
  <tr>
    <th>Titre</th>
    <th>Auteur</th>
    <th>Text</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
   <?php
                         $sql="SELECT * FROM `article`"; 
                         $result=mysqli_query($link,$sql);
                         if (mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
   ?>
  <tr>
    <td><?php echo e($row["titreA"]);?></td>
    <td><?php echo e($row["auteur"]);?></td>
    <td><?php echo e($row["texte"]);?></td>
    <td><?php echo e($row["date"]);?></td>
    <td><a href="modifArticleForm.php?id=<?php echo e($row["idA"]);?>">Modifier</a></td>
  </tr>
<?php 
} }
?>
</table>

</body>
</html>
