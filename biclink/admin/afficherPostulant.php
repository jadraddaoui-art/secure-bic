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

<table id="customers">
  <tr>
    <th>Titre d'emploi</th>
    <th>Nom & Prénom</th>
    <th>Email</th>
    <th>Numero</th>
    <th>Lettre</th>
    <th>CV</th>
  </tr>
   <?php
                         $sql="SELECT * FROM `postuler`"; 
                         $result=mysqli_query($link,$sql);
                         if (mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
   ?>
  <tr>
    <td><?php echo e($row["titre"]);?></td>
    <td><?php echo e($row["name"]);?></td>
    <td><?php echo e($row["email"]);?></td>
    <td><?php echo e($row["phone"]);?></td>
    <td><a href="../cvpostuler/<?php echo e($row["message"]);?>">LM_<?php echo e($row["name"]);?></a></td>
    <td><a href="../cvpostuler/<?php echo e($row["cv"]);?>">CV_<?php echo e($row["name"]);?></a></td>
  </tr>
<?php 
} }
?>
</table>

</body>
</html>
