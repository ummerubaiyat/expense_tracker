<?php

include 'connect.php';
//edit code
if(isset($_GET['edit'])){

  $id =$_GET['edit'];
  $sqlst = "SELECT * FROM  expense_details WHERE id=$id";
  $results = $conn -> query($sqlst);
  $row = $results->fetch_array();


$description =  $row['description'];
$date =  $row['date']; 
$amount =  $row['amount'];
$category =  $row['category'];

}
//update code
if(isset($_POST['submit_details'])){
  $id = $_POST['id'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $inputGroupSelect = $_POST['inputGroupSelect'];
  $amount = $_POST['amount'];
  $sqlst = "UPDATE expense_details SET date='$date',description='$description',category='$inputGroupSelect',amount='$amount' WHERE id= $id";
  $results = $conn -> query($sqlst);
  header('Location: index.php');
}

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

    <title>Edit Page</title>
  </head>
  <body>

    <br><br><br>

    <!-- Main Title Message -->
    <h3 style="text-align: center;">Edit Page</h3>




    <div class="container">


    <form action="" method="post">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <!-- <label for="date">Date</label> -->
                        <input type="date" class="form-control" id="date" name="date" aria-describedby="dateHelp" value="<?php echo $date; ?>">
                        <small id="emaildateHelpHelp" class="form-text text-muted">Enter Transaction Date</small>
                      </div>
                      <div class="form-group">
                        <!-- <label for="description">Description</label> -->
                        <input type="text" class="form-control" name="description" id="description" value="<?php echo $description; ?>">
                      </div>
                      <div class="form-group">
                        
                        <!-- <input type="text" class="form-control" name="category" id="category" placeholder="Category"> -->
                        <select class="custom-select" id="inputGroupSelect" name="inputGroupSelect">
                          <option selected>Category</option>
                          <option value="Salary">Salary</option>
                          <option value="Food">Food</option>
                          <option value="Transportation">Transportation</option>
                          <option value="Misc">Misc</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <!-- <label for="amount">Amount</label> -->
                        <input type="number" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary mr-auto" onclick='goBack()'>Cancel</button>
                      <button type="submit" class="btn btn-primary" name="submit_details">Update</button>
                      
                    </div>
                  </form>
    
    
    </div>
            
                  
       



   <script>
   
   function goBack(){
    location.href = "index.php";
}</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


  </body>
</html>
