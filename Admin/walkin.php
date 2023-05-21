
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$current_date = date('Y-m-d H:i:s');
	$productname=$_POST['product'];
	$price=$_POST['price'];
	$quantity=$_POST['qty'];
	$charge=$_POST['chrge'];
	$totalam=$_POST['totam'];
	$money=$_POST['money'];
	$change=$_POST['changes'];
	
	

$sql="insert into walkinorder(product,price,qty,charge,total,money,changes, orderdate) 
					values('{$productname}','{$price}','{$quantity}','{$charge}','{$totalam}','{$money}','{$change}','{$current_date}')";
mysqli_query($conn,$sql);

$myid = mysqli_insert_id($conn);
$_SESSION['msg']="Ordered Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Walkin Module</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<div class="control-group">
<label class="control-label" for="basicinput">Product</label>
<div class="controls">
<select name="product" class="span8 tip" onChange="getSubcat(this.value);"  required>
<option value="">Select Product</option> 
<?php $query=mysqli_query($conn,"select * from products");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['productName'];?> - P<?php echo $row['productPrice'];?>.00</option>
<option value="<?php echo $row['id'];?>"><?php echo $row['productName'];?> - P25.00</option>
<?php } ?>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Bottle Price</label>
<div class="controls" id="drpdown">
<select name="price" class="span8 tip" onChange="getSubcat(this.value);" id="num0"  required>
<option value="25">Exchange Bottle</option>
<?php $query=mysqli_query($conn,"select * from products");
while($row=mysqli_fetch_array($query))
{?>

<option value="200">New Bottle</option>
<option value="<?php echo $row['productPrice'];?>"><?php echo $row['productPrice'];?>.00</option>
<?php } ?> 
</select>
</div>
</div>

								
<div class="control-group">
<label class="control-label" for="basicinput">Quantity</label>
<div class="controls">
<input type="text"    name="qty" id="num1"  placeholder="Quantity" class="span8 tip" oninput="calculate()" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Charge</label>
<div class="controls">
<input type="text"    name="chrge" id="num2" class="span8 tip" oninput="calculate()" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Total Amount</label>
<div class="controls">
<input type="text" id="result"   name="totam"  class="span8 tip" readonly>
</div>
</div>
								

<div class="control-group">
<label class="control-label" for="basicinput">Money</label>
<div class="controls">
<input type="text"    name="money" id="money" class="span8 tip" oninput="calculateMoney()" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Change</label>
<div class="controls">
<input type="text"  id="changes"  name="changes"  class="span8 tip" readonly>
</div>
</div>


	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Done</button>
												<button type="" name="" class="btn">Cancel</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );

		function calculate() {
			// Get the values from the input fields
			var num0 = parseFloat(document.getElementById("num0").value);
			var num1 = parseFloat(document.getElementById("num1").value);
			var num2 = parseFloat(document.getElementById("num2").value);

			// Perform the calculation
			var cal = num0 * num1;
			var calc = (num1 * num2)
			var result = calc + cal;

			// Update the value of the result textbox
			document.getElementById("result").value = result;
			}


			function calculateMoney() {
			// Get the values from the input fields
			var num4 = parseFloat(document.getElementById("result").value);
			var num3 = parseFloat(document.getElementById("money").value);

			// Perform the calculation
			var changes = num3 - num4;

			// Update the value of the result textbox
			document.getElementById("changes").value = changes;
			}
	</script>
</body>
<?php } ?>