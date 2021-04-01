<!DOCTYPE html>
<html lang="fr">
  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  </head>
<?php 

if ($_GET['ajax']) {
  //echo $_GET['myString'];
include('database_connection.php');
  
  echo'
  <table id="table_modal" class="table table-bordered table-striped" table_jx="table_jx">
        <thead>
        <tr>
        <th class="big-col">Entreprise</th>
        <th class="big-col">Adresse</th>
        <th class="big-col" width=7em>Ville</th>
        <th class="big-col" width=7em>pays</th>
        <th class="big-col" width=7em>Date début</th>
        <th class="big-col" width=7em>Date fin</th>
        <th class="big-col" width=7em>RH</th>
        <th class="big-col" width=7em>Tel RH</th>
        <th class="big-col" width=7em>Mail RH</th>
        <th class="big-col" width=7em>Note stage</th>
        <th class="big-col" width=7em>Note de mission</th>
        <th class="big-col" width=7em>Moyenne</th>
        <th class="big-col" width=7em>Commentaire</th>
        </tr>
      </thead>
        
  ';

$stat = $connect->prepare(" 
                           Select entreprise.NomEntreprise,
                              entreprise.Adresse_1,
                              entreprise.Ville,
                              entreprise.Pays,
                              stage.DateDebut,
                              stage.DateFin,
                              stage.`RH/Contact`,
                              stage.Tel,
                              stage.Mail,
                              stage.Stage,
                              stage.Mission,
                              stage.Moyenne,
                              stage.Comentaire
                              from etudiant
                              inner join stage on etudiant.id_Etudiant = stage.id_Etudiant
                              inner join entreprise on entreprise.id_entreprise = stage.id_Entreprise
                              Where stage.id_Etudiant = :id_Etudiant;
                              
                          ");
                          $stat->execute(
                            array(
                              ':id_Etudiant' => $_GET['id_etudiant']
                            )

                          );
                          $etudiants1 = $stat->fetchAll();
        

          foreach($etudiants1 as $etud)
          {

            echo '
             <tr>
                <td>'.$etud[0].'</td>
                <td>'.$etud[1].'</td>
                <td>'.$etud[2].'</td>
                <td>'.$etud[3].'</td>
                <td>'.$etud[4].'</td>
                <td>'.$etud[5].'</td>
                <td>'.$etud[6].'</td>
                <td>'.$etud[7].'</td>
                <td>'.$etud[8].'</td>
                <td>'.$etud[9].'</td>
                <td>'.$etud[10].'</td>
                <td>'.$etud[11].'</td>
                <td>'.$etud[12].'</td>
                
                
              </tr>
            ';
          }
          echo '</table>';
        }


elseif ($_GET['ajax_referent']) {
  //echo $_GET['myString'];
include('database_connection.php');
  
  echo'
  <table id="table_modal" class="table table-bordered table-striped" table_jx="table_jx">
        <thead>
          <tr>
            
            <th>Civilité</th>
            <th>Nom</th>
           <th >Prénom</th>
          <th >Tel étudiant</th>
          <th >mail étudiant</th>
          <th >mail perso</th>
        <th class="big-col" >Sujet</th>
                <th class="big-col" >Référent pédagogique</th>
        <th class="big-col" >Note stage</th>
        <th class="big-col" >Note de mission</th>
        <th class="big-col" >Moyenne</th>

        <th>Entreprise</th>
            <th>Adresse </th>
           <th>Ville</th>
          <th>Pays</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Maître de stage</th>
          <th>Tel maître</th>
          <th>Mail maître</th>
          <th>RH</th>
          <th>RH Tel</th>
          <th>RH Mail</th>
        <th class="big-col">Commentaire</th>
            

          </tr>
        </thead>
        
  ';

$stat = $connect->prepare(" 
                          Select 
                              etudiant.Civilite,
                              etudiant.Nom,
                              etudiant.Prenom,
                              etudiant.TelEtudiant,
                              etudiant.MailEtudiant,
                              etudiant.MailPerso,
                              stage.Sujet,
                              stage.ReferentPedagogique,
                              stage.Stage,
                              stage.Mission,
                              stage.Moyenne,
                              entreprise.NomEntreprise,
                              entreprise.Adresse_1,
                              entreprise.Ville,
                              entreprise.Pays,
                              stage.DateDebut,
                              stage.DateFin,
                              stage.NomMaitre,
                              stage.TelMaitre,
                              stage.MailMaitre,
                              stage.`RH/Contact`,
                              stage.Tel,
                              stage.Mail,
                              stage.Comentaire

                              from etudiant
                              inner join stage on etudiant.id_Etudiant = stage.id_Etudiant
                              inner join entreprise on entreprise.id_entreprise = stage.id_Entreprise
                              where stage.ReferentPedagogique =:ReferentPedagogique;
                              
                          ");
                          $stat->execute(
                            array(
                              ':ReferentPedagogique' => $_GET['referent']
                            )

                          );
                          $referent2 = $stat->fetchAll();
        

          foreach($referent2 as $referent)
          {

             echo '
             <tr>

                <td>'.$referent[0].'</td>
                <td>'.$referent[1].'</td>
                <td>'.$referent[2].'</td>
                <td>'.$referent[3].'</td>
                <td>'.$referent[4].'</td>
                <td>'.$referent[5].'</td>
                <td>'.$referent[6].'</td>
                <td>'.$referent[7].'</td>
                <td>'.$referent[8].'</td>
                <td>'.$referent[9].'</td>
                <td>'.$referent[10].'</td>
                <td>'.$referent[11].'</td>
                <td>'.$referent[12].'</td>
                <td>'.$referent[13].'</td>
                <td>'.$referent[14].'</td>
                <td>'.$referent[15].'</td>
                <td>'.$referent[16].'</td>
                <td>'.$referent[17].'</td>
                <td>'.$referent[18].'</td>
                <td>'.$referent[19].'</td>
                <td>'.$referent[20].'</td>
                <td>'.$referent[21].'</td>
                <td>'.$referent[22].'</td>
                <td>'.$referent[23].'</td>
                
              </tr>
            ';
          }
          echo '</table>';
        }




elseif ($_GET['ajax_entreprise']) {
  //echo $_GET['myString'];
include('database_connection.php');
  
  echo'
  <table id="table_modal" class="table table-bordered table-striped" table_jx="table_jx">
        <thead>
        <tr>
         <th>Année</th>
        <th>Civilité</th>
            <th>Nom</th>
           <th width=7em>Prénom</th>
          <th width=7em>Tel étudiant</th>
          <th width=7em>mail étudiant</th>
          <th width=7em>mail perso</th>
        <th class="big-col" width=7em>Sujet</th>
        <th class="big-col" width=7em>Référent pédagogique</th>
        <th class="big-col" width=7em>Note stage</th>
        <th class="big-col" width=7em>Note de mission</th>
        <th class="big-col" width=7em>Moyenne</th>
        <th class="big-col" width=7em>Commentaire</th>
        </tr>
      </thead>
        
  ';

$stat = $connect->prepare(" 
                           Select 
                              Year(stage.DateDebut),
                              etudiant.Civilite,
                              etudiant.Nom,
                              etudiant.Prenom,
                              etudiant.TelEtudiant,
                              etudiant.MailEtudiant,
                              etudiant.MailPerso,
                              stage.Sujet,
                              stage.ReferentPedagogique,
                              stage.Stage,
                              stage.Mission,
                              stage.Moyenne,
                              stage.Comentaire
                              from etudiant
                              inner join stage on etudiant.id_Etudiant = stage.id_Etudiant
                              inner join entreprise on entreprise.id_entreprise = stage.id_Entreprise
                              Where stage.id_Entreprise = :id_entreprise;
                              
                          ");
                          $stat->execute(
                            array(
                              ':id_entreprise' => $_GET['id_entreprise']
                            )

                          );
                          $id_entreprises1 = $stat->fetchAll();
        

          foreach($id_entreprises1 as $entrep)
          {

            echo '
             <tr>
                <td>'.$entrep[0].'</td>
                <td>'.$entrep[1].'</td>
                <td>'.$entrep[2].'</td>
                <td>'.$entrep[3].'</td>
                <td>'.$entrep[4].'</td>
                <td>'.$entrep[5].'</td>
                <td>'.$entrep[6].'</td>
                <td>'.$entrep[7].'</td>
                <td>'.$entrep[8].'</td>
                <td>'.$entrep[9].'</td>
                <td>'.$entrep[10].'</td>
                <td>'.$entrep[11].'</td>
                <td>'.$entrep[12].'</td>
                
                
              </tr>
            ';
          }
          echo '</table>';
        }

?>



<script>
  

  $(document).ready(function(){



    var table1 = $('[table_jx="table_jx"]').DataTable({

      "scrollY": "400px",
      "scrollX": "1px",
"scrollCollapse": true,
"order":[],

    
        "pageLength": 25,


         "language": {
          "search": "Recherche:",
          "infoEmpty":      "Affichage de l'élément 0 à 0 sur 0 éléments",
          "zeroRecords":    "Aucune donnée correspondante trouvée",
          "infoFiltered":   "(filtré de _MAX_ éléments)",
          "emptyTable":     "Pas de données dans cette table",
          "lengthMenu":     "Afficher _MENU_ éléments",
          "info":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "paginate": {
      "previous": "Précédent",
      "next": "Suivant"
      
    }

  }

  
    
 

        });
    
    

    
      $('.dataTables_length').addClass('bs-select');
    
  });


</script>



