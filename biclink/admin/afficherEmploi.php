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
    <th>Titre</th>
    <th>Description</th>
    <th>Disponibilite</th>
    <th>Deadline</th>
    <th>Action</th>
  </tr>
   <?php
                         $sql="SELECT * FROM `emploi`"; 
                         $result=mysqli_query($link,$sql);
                         if (mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
   ?>
  <tr>
    <td><?php echo e($row["titreE"]);?></td>
    <td><?php echo e($row["description"]);?></td>
    <td><?php echo e($row["disponibilite"]);?></td>
    <td><?php echo e($row["deadline"]);?></td>
    <td><a href="deleteEmp.php?id=<?php echo e($row["idE"]);?>&token=<?php echo e(csrf_token());?>" onclick="return confirm('Delete this job posting?');">Delete</a></td>
  </tr>
<?php 
} }
?>
</table>

</body>
</html>
