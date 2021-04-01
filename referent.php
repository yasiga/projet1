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
  
  
           
            
            <!-- tester si l'utilisateur est connecté -->
            
      <h3 align="center">Référent pédagogique</h3>

      <br />

     <?php 
     include('database_connection.php');
     ?>
      <div align="right">
        
        <a href="entreprise.php" class="btn btn-info btn-xs">Recherche par entreprise</a></br> 
        <a href="etudiant.php" class="btn btn-info btn-xs">Recherche par étudiant</a></br> 
       
</div>
      <br />
      <table id="data-table" class="table table-bordered table-striped" >
        <thead>
          <tr>
            
            <th>Référent </th>
            

          </tr>
        </thead>
        <?php
        $stat = $connect->prepare(" 
                              Select 
                              distinct(ReferentPedagogique)
                      
                             
                              from stage
                              
                          ");
                          $stat->execute();
                          $referents = $stat->fetchAll();
        

          foreach($referents as $referent)
          {

            echo '
             <tr>

                <td align="center"><a style="color:black"  data-toggle="modal" data-target="#myModal" referent="'.$referent[0].'" >'.$referent[0].'</a></td>
                
              </tr>
            ';
          }
        
        ?>


      </table>

      <h3 align="center">Filtre par année et par sujet (référents)</h3>

      <br />

    
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
        <?php
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
                              
                      
                              
                          ");
                          $stat->execute();
                          $referents = $stat->fetchAll();
        

          foreach($referents as $referent)
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
        
        ?>


      </table>

      
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" croix="croix">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          
          <div id="table_ajax"> </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" fermer="fermer">Fermer</button>
        </div>
      </div>
      
    </div>
  </div>



<script>

$(document).on('click', '[data-target="#myModal"]', function(){
        var referent = $(this).attr("referent");
        

        $(".modal-title").text(referent);


        $.ajax({
      method: 'get',
      url: 'table_etudiant.php',
      data: {
        'referent': referent,
        'ajax_referent': true
      },
      success: function(data) {
        $('.modal-body').html(data);

      }

      
      
    });





      });




</script>

  


   
</html>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#data-table').DataTable({
      "scrollY": "400px",
     
"scrollCollapse": true,
          "order":[],
       
        "pageLength": 25,


         "language": {
          "search": "Recherche:",
          "infoEmpty":      "Affichage de l'élément 0 à 0 sur 0 éléments",
          "zeroRecords":    "Aucune donnée correspondante trouvée",
          "infoFiltered":   "(filtré de _MAX_ éléments)",
          "lengthMenu":     "Affichage _MENU_ éléments",
          "emptyTable":     "Pas de données dans cette table",
          "lengthMenu":     "Afficher _MENU_ éléments",
          "info":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "paginate": {
      "previous": "Précédent",
      "next": "Suivant"
      
    }

  }

  
    
  
 

        });

    var table1 = $('[table="table"]').DataTable({

      "scrollY": "400px",
      "scrollX": "10px",
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



