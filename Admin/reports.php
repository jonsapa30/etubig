<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

    // $sql ="SELECT SUM(`quantity`) as 'QTY' FROM `orders` GROUP BY `productId`";
     $sql ="SELECT *,SUM(quantity) as 'qty' FROM category c, `products` p, `orders` o WHERE c.id=p.category AND p.`id`=o.`productId` GROUP BY p.category";
     $result = mysqli_query($conn,$sql);
     $chart_data="";
     while ($row = mysqli_fetch_array($result)) {
         # code...
        $productname[] =  $row['categoryName'];
        $orders[] =  $row['qty'];

     } 
     // $chart_data=substr($chart_data, 0,-2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Dashboard</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    </head>
    <body>
        <?php include('include/header.php');?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                <?php include('include/sidebar.php');?>		
                    
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                             
                                <div class="btn-box-row row-fluid">
                               
                                <h2 class="page-header" >Sales Report Online Orders</h2> 
                               

                                 <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered  display" width="100%">
                                
                                    <thead>
                                    <tr>
                                        <th>Transaction Date</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>   
                                    </tr>
                                    </thead>

                                <tbody> 
                                <?php
                                $totamount =0;
                                $totamounts =0;
                                $totprice =0;
                                $totqty =0;
                                // `category`, `productName`, `productPrice`
                                    $sql="SELECT *,(productPrice*quantity) as 'tot', (productPriceBeforeDiscount*quantity) as 'tots', o.type as otype FROM category c, `products` p,`orders` o WHERE c.id=p.category AND  p.id=`productId` AND orderStatus='Delivered'";
                                  $result =  mysqli_query($conn,$sql);
                                  while($row = mysqli_fetch_array($result)){


                                    echo '<tr>';
                                    echo '<td>'.$row['orderDate'].'</td>';
                                    echo '<td>'.$row['productName'].'</td>';
                                    echo '<td>'.$row['categoryName'].'</td>';

                                    if($row['otype'] == '1') {
                                    echo '<td>'.$row['productPriceBeforeDiscount'].'</td>';
                                    }
                                    else {
                                        echo '<td>'.$row['productPrice'].'</td>';
                                    }
                                    echo '<td>'.$row['quantity'].'</td>';
                                    
                                    if($row['otype'] == '1') {
                                        echo '<td>'.$row['tots'].'</td>'; 
                                    }
                                    else {
                                        echo '<td>'.$row['tot'].'</td>'; 
                                    }
                                    echo '</tr>';
                                   // $totprice += $row['productPrice'];
                                    $totqty += $row['quantity'];

                                    if($row['otype'] == '1') {
                                        $totamount += $row['tots'];
                                    }
                                    else {
                                        $totamount += $row['tot'];
                                    }
                                   

                                  }

                                 ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <td colspan="3">Total</td>
                                         <td><?php //echo  $totprice; ?></td>
                                         <td><?php echo  $totqty; ?></td>
                                         <td><?php echo $totamount; ?>.00</td>
                                     </tr>
                                 </tfoot>
                                </table>
                      

<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered  display" width="100%">

   <thead>
   <tr>
       <th>Transaction Date</th>
       <th>Product</th>
       <th>Category</th>
       <th>Price</th>
       <th>Quantity</th>
       <th>Total Amount</th>   
   </tr>
   </thead>

<tbody> 
<?php
$totams =0;
$tots =0;
// `category`, `productName`, `productPrice`
   $sql="SELECT walkinorder.*, products.productName as prod FROM walkinorder left join products on walkinorder.product = products.id";
 $result =  mysqli_query($conn,$sql);
 while($row = mysqli_fetch_array($result)){


   echo '<tr>';
   echo '<td>'.$row['orderdate'].'</td>';
   echo '<td>'.$row['prod'].'</td>';
   echo '<td>'.'Walkin'.'</td>';
   echo '<td>'.$row['price'].'</td>';
   echo '<td>'.$row['qty'].'</td>';
   echo '<td>'.$row['total'].'</td>';
   $tots += $row['qty'];
   $totams += $row['total'];
 }

?>
</tbody>
<tfoot>
    <tr>
        <td colspan="3">Total</td>
        <td><?php //echo  $totprice; ?></td>
        <td><?php echo  $tots; ?></td>
        <td><?php echo $totams; ?>.00</td>
    </tr>
</tfoot>
</table>
                                <!-- <canvas id="chartjs_pie"></canvas> -->
                           
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
<?php include('include/footer.php');?>

  <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script> 
    <script src="assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>  
    <script src="assets/vendor/charts/charts-bundle/chart.js"></script> 
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($orders); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',

                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },

                    
                }
                });
    </script>

    </body>
    <?php } ?>
