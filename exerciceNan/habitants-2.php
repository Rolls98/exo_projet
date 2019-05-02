<?php 
  include 'database.php';

  $db =  database::connexion();

  $id = $_GET['id'];

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
  <h2>Table des habitants de l'Afrique</h2>

  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>commune</th>
        <th>solde</th>
        <th>numéro</th>
      </tr>
    </thead>
     
    <tbody>
      <?php 
      
      $stament = $db->prepare("SELECT habitants.id,habitants.nom,habitants.prenom,communes.nom  as cnom,pays.id_continent as pc,habitants.solde,habitants.numero FROM habitants LEFT JOIN communes ON communes.id = habitants.id_quartier LEFT JOIN villes ON villes.id=communes.id_ville LEFT JOIN pays ON villes.id_pays = pays.id WHERE pays.id_continent = ?  ORDER BY habitants.solde ");
        $stament->execute(array($id));
      $total = 0;

      $rows = $stament->fetchALL();

      foreach($rows as $element)
         {
            echo'<tr>';
              echo '<td>'.$element['nom'].'</td>';
              echo'<td>'.$element['prenom'].'</td>';
              echo '<td>'.$element['cnom'].'</td>';
              echo'<td>'.$element['solde'].'</td>';
              echo '<td>'.$element['numero'].'</td>';
              $total += $element['solde']; 
            echo'</tr>';
          }
        ?>
    </tbody>
    <tfooter>
      <tr>
        <th>Total</th>
        <th></th>
        <th></th>
        <th><?php echo $total; ?></th>
        <th></th>
      </tr>
    </tfooter>
  </table>
</div>

</body>
</html>
