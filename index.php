 <!-- Transaction Calculation Start -->
<?php

include 'connect.php';

$sql_debit_sum = "SELECT SUM(`amount`) AS TotalDebitvalue FROM expense_details where `category`='Salary' ";
$result_debit_sum = $conn -> query($sql_debit_sum);

$print_debit_sum = $result_debit_sum ->fetch_array();
$total_debit = $print_debit_sum['TotalDebitvalue'];


$sql_credit_food = "SELECT SUM(`amount`) AS FoodCreditvalue FROM expense_details where `category`= 'Food'";
$result_credit_food = $conn -> query($sql_credit_food);
$print_credit_food = $result_credit_food ->fetch_array();

$sql_credit_misc = "SELECT SUM(`amount`) AS MISCCreditvalue FROM expense_details where `category`= 'Misc'";
$result_credit_misc = $conn -> query($sql_credit_misc);
$print_credit_misc = $result_credit_misc ->fetch_array();

$sql_credit_trans = "SELECT SUM(`amount`) AS TransCreditvalue FROM expense_details where `category`= 'Transportation'";
$result_credit_trans = $conn -> query($sql_credit_trans);
$print_credit_trans = $result_credit_trans ->fetch_array();


$total_credit_sum = $print_credit_food['FoodCreditvalue'] + $print_credit_misc['MISCCreditvalue'] + $print_credit_trans['TransCreditvalue'];


// $sqlst = "SELECT SUM(`amount`) AS totalcreditvalue FROM  expense_details ";
// $resultst = $conn -> query($sqlst);

// $datast = $resultst ->fetch_array();
// $datat = $datast['totalcreditvalue'];

// $maincredit = $datat-$total_debit;


?>

<!-- Transaction Calculation Start -->

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

    <title>Expense Tracker</title>
  </head>
  <body>

    <br><br><br>

    <!-- Main Title Message -->
    <h3 style="text-align: center;">Expense Tracker</h3>

    <!-- Transaction Store Container -->

    <div class="container">
        <div class="row">
        <div class="col-md-2 col-6">
            Total Debit: <?php
            if( $total_debit){echo $total_debit;}else{ echo $total_debit=0;}  ; ?>
        </div>
          
        <div class="col-md-2 col-6 offset-md-8">
            Total Credit: <?php echo $total_credit_sum; ?>
        </div>
        </div>
    </div>

    <!-- Main Container -->

    <div class="container main">
        


          <br><br>

          
          
          <!-- Add Transaction Button  -->
          
          <div class="col-md-3 mb-3">

            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#form"><i class="fa fa-plus"></i></button>
            
           </div>
          </div>

          <!-- Add Transaction Button  End-->          

          <!-- Delete Transaction Start --> 
            <?php

         

          if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $sql_delete = "DELETE FROM  expense_details WHERE id=$id";
            $resul_delete = $conn -> query($sql_delete);
            header('Location: index.php');

          }


            ?>
          <!-- Delete Transaction End --> 


        <!--Fetch Account Header Start-->

          <div class="container">
            <div class="form-row">

        
                    <div class="col-md-3 mb-3">
                      
                      <input class="form-control" type="text" placeholder="Date" readonly>
                      
                    </div>
                    <div class="col-md-3 input-group mb-3">
                        
                    <input class="form-control" type="text" placeholder="Category" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                      
                      <div class="input-group">
                         
                      <input class="form-control" type="text" placeholder="Amount" readonly>
                        
                      </div>
                    </div>
                    <div class="col-md-2 mb-1 col-6">
                       
                        <div class="btn-group" role="group">
                            <button type="button"  class="btn btn-primary customize" onclick=" report()">All Report</button>
                        
                       </div>
                       
                    </div>
                </div>

                  <!--Fetch Account Header End-->




                  <!--Fetch Account Details Contents Start-->


                  <?php
                
                include_once 'connect.php';

                if ($conn -> connect_errno) {
                  echo "Failed to connect to MySQL: " . $conn -> connect_error;
                  exit();
                }

                $sql_fetch_result = "SELECT id,category, amount, date FROM expense_details ORDER BY date DESC";
                $result = $conn -> query($sql_fetch_result);
   
                ?>

                <?php while($row = mysqli_fetch_array($result)){ ?>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                      
                      <input type="date" class="form-control" type="date" placeholder="Date" value="<?php echo  $row["date"] ?>" readonly>
                      
                    </div>
                    <div class="col-md-3 input-group mb-3">
                        
                        <select class="custom-select" id="inputGroupSelect" name="inputGroupSelect">
                        <?php 
                        if($row["category"]=='Food') { ?>
                        <option value="Food" selected>Food</option>
                        <?php } elseif($row["category"]=='Salary') {?>
                          <option value="Salary" selected>Salary</option>
                        <?php }elseif($row["category"]=='Transportation'){ ?>
                          <option value="Transportation" selected>Transportation</option>
                        <?php } elseif($row["category"]=='Misc'){ ?>
                          <option value="Misc" selected >Misc</option>
                        <?php } ?>
                          
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                      
                      <div class="input-group">
                         
                        <input type="number" class="form-control"  placeholder="Amount" aria-describedby="inputGroupPrepend" value="<?php echo  $row["amount"] ?>" readonly>
                        
                      </div>
                    </div>
                    <div class="col-md-1 mb-1 col-3">
                       
                        <div class="btn-group" role="group">
                            <a href="edit.php?edit=<?php echo $row["id"]; ?>" class="btn btn-primary edit" role="button"><i class="fa fa-edit"></i></a>
                        
                       </div>
                       
                    </div>
    
                    <div class="col-md-1 mb-1 offset-col-12 col-3">
                        
                         <div class="btn-group" role="group">
                             <a href="index.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger delete" role="button"><i class="fa fa-trash"></i></a>
                         </div>
                        
                        
                     </div>
                    
                </div>
                <?php } ?>
                <br><br>

           </div>
                  <!--Fetch Account Details Contents End-->



            <!-- Add Account Modal Container Start -->
            
            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="index.php" method="post">
                    <div class="modal-body">
                      <div class="form-group">
                        
                        <input type="date" class="form-control" id="date" name="date" aria-describedby="dateHelp" placeholder="Date">
                        <small id="emaildateHelpHelp" class="form-text text-muted">Enter Transaction Date</small>
                      </div>
                      <div class="form-group">
                        
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                      </div>
                        
                      <div class="form-group">
                        
                        
                        <select class="custom-select" id="inputGroupSelect" name="inputGroupSelect">
                          <option selected>Category</option>
                          <option value="Salary">Salary</option>
                          <option value="Food">Food</option>
                          <option value="Transportation">Transportation</option>
                          <option value="Misc">Misc</option>
                        </select>
                      </div>
                      <div class="form-group">
                        
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" name="submit_details">Save</button>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>

           <!-- Add Account Modal Container End -->

          </div>

            <!-- Transaction Form Submit Start -->
              <?php
              ob_start();
              include_once 'connect.php';
              if(isset($_POST['submit_details']))
              {	 
                                
                                $transaction_date = $_POST['date'];
                                $description = $_POST['description'];
                                $category = $_POST['inputGroupSelect'];
                                $transaction = $_POST['amount'];
                                // $created_at = $_POST[''];
                                //$created_at = date('Y-m-d');
                                $sql_insert = "INSERT INTO expense_details (date,description,category,amount)
                                VALUES ('$transaction_date','$description','$category','$transaction')";
                                if (mysqli_query($conn, $sql_insert)) {
                                  header('Location: index.php');
                                  
                                } else {
                                  echo "Error: " . $sql_insert . "
                              " . mysqli_error($conn);
                                }
                                mysqli_close($conn);
                                
                                
              }
              ob_flush();
              ?>

            <!-- Transaction Form Submit End -->


            <script>
            function report()
            {
                location.href = "report.php";
            } 
            </script>


<script>
    function reloadPage(){
        location.reload(true);
    }
</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
  </body>
</html>
