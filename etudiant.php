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
            
      <h3 align="center">Informations sur les étudiants</h3>

      <br />

     <?php 
     include('database_connection.php');
   ?>
      <br />
       <div align="right">
        
        <a href="entreprise.php" class="btn btn-info btn-xs">Recherche par entreprise</a></br> 
        <a href="referent.php" class="btn btn-info btn-xs">Recherche par reférent pédagogique</a></br> 
       
</div>
      <table id="data-table" class="table table-bordered table-striped" >
        <thead>
          <tr>
            <th>Civilite</th>
            <th>Nom</th>
           <th width=7em>Prénom</th>
          <th width=7em>Tel étudiant</th>
          <th width=7em>mail étudiant</th>
          <th width=7em>mail perso</th>
          </tr>
        </thead>
        <?php
        $stat = $connect->prepare(" 
                              SELECT * FROM etudiant
                          ");
                          $stat->execute();
                          $etudiants = $stat->fetchAll();
        

          foreach($etudiants as $etudiant)
          {

            echo '
             <tr>

                <td>'.$etudiant[1].'</td>
                <td><a style="color:black"  data-toggle="modal" data-target="#myModal" id_etudiant="'.$etudiant[0].'" nom_prenom ="'.$etudiant[2].' '.$etudiant[3].'" >'.$etudiant[2].'</a></td>
                <td>'.$etudiant[3].'</td>
                <td>'.$etudiant[4].'</td>
                <td>'.$etudiant[5].'</td>
                <td>'.$etudiant[6].'</td>

                
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
        var nom_prenom = $(this).attr("nom_prenom");
        var id_etudiant = $(this).attr("id_etudiant");

        $(".modal-title").text(nom_prenom);


        $.ajax({
      method: 'get',
      url: 'table_etudiant.php',
      data: {
        'id_etudiant': id_etudiant,
        'ajax': true
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



