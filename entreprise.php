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
            
      <h3 align="center">Les entreprises</h3>

      <br />

     <?php 
     include('database_connection.php');
   ?>
      <br />
       <div align="right">
        
        <a href="etudiant.php" class="btn btn-info btn-xs">Recherche par étudiant</a></br> 
        <a href="referent.php" class="btn btn-info btn-xs">Recherche par reférent pédagogique</a></br> 
       
</div>
      <table id="data-table" class="table table-bordered table-striped" >
        <thead>
          <tr>
            
            <th>Entreprise</th>
            <th>Adresse </th>
           <th width=7em>Ville</th>
          <th width=7em>Pays</th>
          <th width=7em>Maître de stage</th>
          <th width=7em>Tel maître</th>
          <th width=7em>Mail maître</th>

          <th width=7em>RH</th>
          <th width=7em>RH Tel</th>
          <th width=7em>RH Mail</th>

          </tr>
        </thead>
        <?php
        $stat = $connect->prepare(" 
                              Select 
                              distinct(entreprise.id_entreprise),
                              entreprise.NomEntreprise,
                              entreprise.Adresse_1,
                              entreprise.Ville,
                              entreprise.Pays,
                              stage.NomMaitre,
                              stage.TelMaitre,
                              stage.MailMaitre,
                              stage.`RH/Contact`,
                              stage.Tel,
                              stage.Mail
                             
                              from etudiant
                              inner join stage on etudiant.id_Etudiant = stage.id_Etudiant
                              inner join entreprise on entreprise.id_entreprise = stage.id_Entreprise;
                          ");
                          $stat->execute();
                          $entreprises = $stat->fetchAll();
        

          foreach($entreprises as $entreprise)
          {

            echo '
             <tr>

                <td><a style="color:black"  data-toggle="modal" data-target="#myModal" id_entreprise="'.$entreprise[0].'" entreprise ="'.$entreprise[1].'" >'.$entreprise[1].'</a></td>
                <td>'.$entreprise[2].'</td>
                <td>'.$entreprise[3].'</td>
                <td>'.$entreprise[4].'</td>
                <td>'.$entreprise[5].'</td>
                <td>'.$entreprise[6].'</td>
                <td>'.$entreprise[7].'</td>
                <td>'.$entreprise[8].'</td>
                <td>'.$entreprise[9].'</td>
                <td>'.$entreprise[10].'</td>






                
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
        var entreprise = $(this).attr("entreprise");
        var id_entreprise = $(this).attr("id_entreprise");

        $(".modal-title").text(entreprise);


        $.ajax({
      method: 'get',
      url: 'table_etudiant.php',
      data: {
        'id_entreprise': id_entreprise,
        'ajax_entreprise': true
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



