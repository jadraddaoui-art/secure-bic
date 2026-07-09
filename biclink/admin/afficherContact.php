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

<a href="updatepage.php"> <h1>affichage des messages</h1></a>
<table id="customers">
  <tr>
    <th>Nom & Prénom</th>
    <th>Email</th>
    <th>message</th>
  </tr>
   <?php
                         $sql="SELECT * FROM `contact`"; 
                         $result=mysqli_query($link,$sql);
                         if (mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
   ?>
  <tr>
    <td><?php echo e($row["name"]);?></td>
    <td><?php echo e($row["email"]);?></td>
    <td><?php echo e($row["message"]);?></td>
  </tr>
<?php 
} }
?>
</table>

</body>
</html>
