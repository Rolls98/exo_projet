<?php 
  include 'database.php';

  $db =  database::connexion();
  $id = $_GET['id'];

  $st = $db->prepare("SELECT id as nombre FROM pays WHERE id_continent= ?");

  $st->execute(array($id));

  while($rows = $st->fetch())
  {
    $last = $rows['nombre'];
  }
  
?>


<?php
  
    if(!empty($_POST))
    {
      $ville1 = $_POST['ville1'];
      $ville2 = $_POST['ville2'];
      $ville3 = $_POST['ville3'];

      if(!empty($ville1))
      {
        $ajout = $db->prepare("INSERT INTO villes(nom,id_pays) VALUES(?,?)");
        $ajout->execute(array($ville1,$last));
      }

      if(!empty($ville2))
      {
         $ajout = $db->prepare("INSERT INTO villes(nom,id_pays) VALUES(?,?)");
        $ajout->execute(array($ville2,$last));
      }

      if(!empty($ville3))
      {
         $ajout = $db->prepare("INSERT INTO villes(nom,id_pays) VALUES(?,?)");
        $ajout->execute(array($ville3,$last));
      }
    }

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
</head>
<body>

<div class="container">
  <h2>Table des pays de l'Afrique</h2>
<form class="form-group" method="POST" action="<?php echo 'pays.php?id='.$id;?>">
    <input class="from-control" name="ville1" placeholder="Entrez un nom">
     <input class="from-control" name="ville2" placeholder="Entrez un nom">
      <input class="from-control" name="ville3" placeholder="Entrez un nom">
      <button type="submit" class="btn btn-primary">Ajouter 3 villes</button>
      
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Nombre de villes</th>
      </tr>
    </thead>
    <tbody>
     <?php 
      $charge = $db = $db->prepare("SELECT pays.nom,pays.superficie,count(villes.id_pays) as nbvilles FROM pays LEFT JOIN villes on pays.id = villes.id_pays WHERE pays.id_continent = ? GROUP BY pays.nom");
      $charge->execute(array($id));
      while($row = $charge->fetch())
     {  
        echo'<tr>';
        echo '<td>'.$row['nom'].'</td>';
        echo'<td>'.$row['superficie'].'</td>';
        echo'<td>'.$row['nbvilles'].'</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
