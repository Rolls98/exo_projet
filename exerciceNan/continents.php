<?php 
  include 'database.php';

  $db =  database::connexion();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <style type="text/css">
    
    a
    {
      display: inline-block;
      margin-right:10px;
    }

  </style>
</head>
<body>

<div class="container">
  <h2>Table des continents</h2>      
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php
        $stament = $db->query("SELECT * FROM continents");

        while($row = $stament->fetch())
      {
        echo'<tr>';
              echo '<td>'.$row['nom'].'</td>';
             echo '<td>'.$row['superficie'].'</td>';
              echo '<td>';
                 echo '<a href="pays.php?id='.$row['id'].'" class="btn btn-primary">Voir pays</a>';
                  echo '<a href="villes.php?id='.$row['id'].'" class="btn btn-success">Voir villes</a>';
                   echo '<a href="habitants-1.php?id='.$row['id'].'" class="btn btn-danger">Voir habitants</a>';
              echo'</td>';
            echo'</tr>';
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
