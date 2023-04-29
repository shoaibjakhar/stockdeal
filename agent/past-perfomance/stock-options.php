<?php
 include('connection/dbconnection_cms.php');
 
$stock_options_data = getAll('Options','order by id desc');

if($_POST){
    $data = array(
                'Date'=>$_POST['Date'],
                'Scrip'=>$_POST['Scrip'],
                'CMP'=>$_POST['CMP'],
                'Target'=>$_POST['Target'],
                'Exit_Price'=>$_POST['Exit_Price'],
                'Investment'=>$_POST['Investment'],
                'Profit_Loss'=>$_POST['Profit_Loss'],
                'Class'=>$_POST['Class']
            );

    $ins = insert('Options',$data);

    header('location:stock-options.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Stock Options</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css">
    
</head>

<body>

    <div class="container">
        <h2 class="section-title text-center"> <span class="divider-left"></span> PAST PERFORMANCE <span class="divider-right"></span> </h2>
    </div>
    <div class="container">
        <ul class="tab1">
            <a href="equity-intraday.php" target="_self">
                <li id="tab1">Equity Intraday</li>
            </a>
            <a href="index-options.php" target="_self">
                <li id="tab2">Index Options</li>
            </a>
            <a href="future-intraday.php" target="_self">
                <li id="tab3" class="">Future Intraday</li>
            </a>
            <a href="stock-options.php" target="_self">
                <li class="active"  id="tab4">Stock Options</li>
            </a>
            <a href="index.php" target="_self">
                <li id="tab8">Index</li>
            </a>
        </ul>
    </div>

    <div class="container">
       
        <table class="table table-bordered" style="margin-top:20px; ">
            <tr style="font-weight: 900">
                <td>Date</td>
                <td>Scrip</td>
                <td>CMP</td>
                <td>Target</td>
                <td>Exit Price</td>
                <td>Investment</td>
                <td>Profit Loss</td>
                <td>Class</td>
                <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Add Stock Options</a> </td>
            </tr>

            <?php

                if($stock_options_data){
                    foreach ($stock_options_data as $key => $value) {
                  
            ?>
            <tr>
                <td><?php echo $value['Date']; ?></td>
                <td><?php echo $value['Scrip']; ?></td>
                <td><?php echo $value['CMP']; ?></td>
                <td><?php echo $value['Target']; ?></td>
                <td><?php echo $value['Exit_Price']; ?></td>
                <td><?php echo $value['Investment']; ?></td>
                <td><?php echo $value['Profit_Loss']; ?></td>
                <td><?php echo $value['Class']; ?></td>
                <td><a href="delete_stock-options.php?id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php


                    }
                }
            ?>
            <!-- 1 // -->

           

        </table>
    </div>

    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalCenterTitle">Add Stock Options</h3>
                    
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date</label>
                                <input type="date" class="form-control" id="Date" name="Date" placeholder="Date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Scrip</label>
                                <input type="text" class="form-control" id="Scrip" name="Scrip" placeholder="Scrip">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">CMP</label>
                                <input type="text" class="form-control" id="CMP" name="CMP" placeholder="CMP">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Target</label>
                                <input type="text" class="form-control" id="Target" name="Target" placeholder="Target">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Exit Price </label>
                                <input type="text" class="form-control" id="Exit Price" name="Exit_Price" placeholder="Exit Price">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Investment</label>
                                <input type="text" class="form-control" id="Investment" name="Investment" placeholder="Investment">
                            </div>
                        </div>

                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Profit Loss</label>
                                <input type="text" class="form-control" id="Profit Loss" name="Profit_Loss" placeholder="Profit Loss">
                            </div>
                             <div class="form-group col-md-6">
                                <label for="inputEmail4">Class</label>
                              
                                
                                <select name="Class" class="form-control" id="Class" name="Class" >
  <option value="" selected>Select</option>
  <option value="positive">Positive</option>
  <option value="negative">Negative</option>
</select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
     <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalCenterTitle">Equity Intraday</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    <div id="update_body"></div>
                 </div>
            </div>
        </div>
    </div>
    
    
    
  <script>
      $(document).ready(()=>{
          $(".update_data").click((e)=>{
              var id = e.target.id;
              $("#updateModal").modal('show');
              $("#update_body").load('edit_stock-options.php?id='+id);
          })
      })
  </script>  
    

</body>

</html>
