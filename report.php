<?php

include 'connect.php';
$sql_report = "SELECT id,category,amount, description, date FROM expense_details ORDER BY date DESC";
$result_report = $conn -> query($sql_report);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <title>Report</title>
    
  </head>
  <body>

    <br><br><br>
    <h3 style="text-align: center;">Report  Page</h3>


                   
                   
  <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
               
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_array($result_report)){ ?>
            <tr>
                <td><?php echo  $row["date"] ?></td>
                <td><?php echo  $row["description"] ?></td>
                <td><?php echo  $row["category"] ?></td>
                <td><?php echo  $row["amount"] ?></td>
              
            </tr>
            <?php } ?>
           
        </tbody>
        
    </table>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>

  
  </body>
</html>
