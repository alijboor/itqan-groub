<?php
session_set_cookie_params(99999999,"/");
session_start();
require 'connection.php';

$theaccountid = 0;
// $result=mysqli_query($conn, "select userid from webtokens where sid = '" . session_id() . "'");
// orders page
$res_orders=mysqli_query($conn, "select * from orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel='stylesheet' href='ind.css'>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
	<table class="table table-sm">
		<thead>
			<tr>
			<th scope="col">account name</th>
			<th scope="col">Order Type</th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php while($res= mysqli_fetch_array($res_orders)){
				$theaccountid= $res['theaccountid'];
				$q_account_name = mysqli_query($conn, "SELECT accountstring from accounts WHERE accountid == $theaccountid");
				echo $q_account_name;
				?>
			<div>
				<tr>
					<th ></th>
					<td><?php echo $q_account_name; ?></td>
					<td ></td>
					<td></td>
					<td>
						<!-- <a href='<?php echo "orderitem.php?id=".$res['detid']; ?>'class="btn btn-danger">
							<i class="fa fa-times ml-1"></i>
							Check item
						</a> -->
						<button href="#" id="btns" class="btn btn-danger" name = "btns">Check item</button>
					</td>
				</tr>
			</div>
				<?php }?>
		</tbody>
	</table>	

	<form action="updateitem.php" method="post" >
		<div class="bg-modal">
			<div class="modal-contents">
				<div class="close">+</div>
				<form action="">
					<select name="state" id="state">
						<option ></option>
						<option value="<?php echo $status;?>" <?php if ($status == 'G') echo 'selected'; ?> style='background-color:LimeGreen'>تم التجهيز</option>
						<option value="<?php echo $status;?>" <?php if ($status == 'R') echo 'selected'; ?> style='background-color:red'>غير جاهز</option>
						<option value="<?php echo $status;?>" <?php if ($status == 'M█3') echo 'selected'; ?> style='background-color:rgb(240, 15, 146)'>تجهيز جزئي</option>
					</select>
					<input type="text" placeholder="<?php echo $res['quantity'];?>" disabled>
					<a href="#" class="btn btn-success">Submit</a>
				</form>
			</div>
		</div>
	</form>
	<script>

		// var btn = querySelectorAll("a.btns")
		// btn.forEach(elem => {
		// 	elem.addEventListener("click", () => {
		// 	var el = querySelector(".bg-modal")
		// 	el.classList.toggle("show"); 
		// 	$('.bg-modal').modal('show');
		// 	})
		// });

		document.getElementById('btns').addEventListener("click", function() {
			document.querySelector('.bg-modal').style.display = "flex";
		});
		document.querySelector('.close').addEventListener("click", function() {
		document.querySelector('.bg-modal').style.display = "none";
		});
	</script>


</body>
</html>