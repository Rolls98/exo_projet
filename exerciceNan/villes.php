<?php 
  include 'database.php';

  $db =  database::connexion();

  $id = $_GET['id'];


  if(!empty($_POST))
  {
      $superficie = $_POST['superficie'];
      $pays=$_POST['pays'];

      if(!empty($pays) AND !empty($superficie))
      {
        $mod = $db->prepare("UPDATE villes SET superficie=? WHERE nom = ?");
        $mod->execute(array($superficie,$pays));
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

 <style type="text/css">
    
    button
    {
      display: inline-block;
      margin-top:2px;
    }

  </style>
<body>

<div class="container">
  <h2>Table des habitants de l'Afrique</h2>
<form class="form-group" method="POST" action="<?php echo'villes.php?id='.$id;?>">
    <input class="form-control" name="superficie" placeholder="Entrez une Taille en km2">
    <div class="row">
        <div class="col-md-6">
            <select class="form-control" value="" name="pays">
            <?php
              $stament = $db->prepare("SELECT villes.id_pays,villes.nom,villes.superficie,pays.nom as pnom FROM villes LEFT JOIN pays ON pays.id=villes.id_pays WHERE pays.id_continent=?");
              $stament->execute(array($id));
              $rows = $stament->fetchALL();
            foreach ($rows as $element) {
             echo '<option value="'.$element['nom'].'"name='.$element['nom'].'>'.$element['nom'].'</option>';
            }
            ?>
            </select>
        </div>
        <div class="col-md-6">
                <button class="btn btn-primary">Modifier la superficie</button>

        </div>
    </div>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Pays</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          
          foreach ($rows as $element) 
          {
            echo '<tr>';
              echo '<td>'.$element['nom'].'</td>';
              echo '<td>'.$element['superficie'].'</td>';
              echo '<td>'.$element['pnom'].'</td>';
            echo '</tr>';
          }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
