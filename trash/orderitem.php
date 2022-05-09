<?php
session_set_cookie_params(99999999,"/");
session_start();
require 'connection.php';

// $userid = 0;
// $result=mysqli_query($conn, "select userid from webtokens where sid = '" . session_id() . "'");
// $result=mysqli_query($conn, "select userid from users where userid = 2");

// order page details
$res_orderdet=mysqli_query($conn, "SELECT ordersdet.detid, ordersdet.quantity, items.itemstring,items.barcode, ordersdet.status FROM ordersdet INNER JOIN items ON ordersdet.theitemid=items.itemid;");
// while($r = mysqli_fetch_assoc($result)) 
// {
// 	$userid = $r['userid'];
// 	echo $userid;	
// }

// function startsWith ($string, $startString)
// {
//     $len = strlen($startString);
//     return (substr($string, 0, $len) === $startString);
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel='stylesheet' href='ind.css'>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="search">
		<input type="text" placeholder="Search" id="search">
		<button class="btn btn-primary mb-2" onclick="alerting()">Search</button>
	</div>
	<table class="table table-sm" id="table-data">
		<thead>
			<tr>
			<th scope="col">name</th>
			<th scope="col">quantity</th>
			<th scope="col">status</th>
			<th scope="col">barcode</th>
			<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php while($data_res= mysqli_fetch_array($res_orderdet)){
				$status= $data_res['status'];
				?>
			<div>
				<tr id="<?php echo $status[0]; ?>">
					<td><?php echo $data_res['itemstring'];?></td>
					<th scope="row"><?php echo abs($data_res['quantity'])?></th>
					<td><?php echo $status; ?></td>
					<td><?php echo $data_res['barcode'];?></td>
					<td>
						<a href="#" class="btn btn-danger" onclick="open_popup()">Check item</a>
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
					<select name="state" id="state">
						<option ></option>
						<option value="<?php echo $status;?>" <?php if ($status == 'G') echo 'selected'; ?> style='background-color:LimeGreen'>تم التجهيز</option>
						<option value="<?php echo $status;?>" <?php if ($status == 'R') echo 'selected'; ?> style='background-color:red'>غير جاهز</option>
						<option value="<?php echo $status;?>" <?php if ($status[0] == 'M') echo 'selected'; ?> style='background-color:rgb(240, 15, 146)'>تجهيز جزئي</option>
					</select>
					<input type="text" placeholder="<?php echo $res['quantity'];?>" disabled>
				<a href="#" class="btn btn-success">Submit</a>

			</div>
		</div>
	</form>
	<script>
		document.querySelector('.close').addEventListener("click", function() {
		document.querySelector('.bg-modal').style.display = "none";
		});

		function open_popup() {
			document.querySelector('.bg-modal').style.display = "flex";
		}

		function alerting() {
			var x = document.getElementById("search").value;
			let  barcods = [];
			var table = document.getElementById("table-data");

			for (var i = 0, row; row = table.rows[i]; i++) {
				console.log(row.cells[3]);
				barcods[i] = row.cells[3]; 
			}
			console.log(barcods);
		}

	</script>


</body>
</html>