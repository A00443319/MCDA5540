<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

	<link rel="stylesheet" href="./css/bootstrap.min.css">
   
  </head>
  <body>
  <div class="container">
   
    <?php
		include 'header.html';
        include 'db_connection.php';
        $conn = OpenCon();

		if(isset($_POST["submit"])){
			$fname = htmlentities($_POST["fname"]);
			$lname = htmlentities($_POST["lname"]);
			$addr = htmlentities($_POST["addr"]);
			$phone = htmlentities($_POST["phone"]);
			
			$cust_exist_query = "SELECT * FROM CUSTOMER where fname = '$fname' and lname = '$lname'";
		
			$doesExist = mysqli_query($conn, $cust_exist_query);
			if (!$doesExist) print("ERROR: ".mysqli_error($conn));
			
			if (mysqli_num_rows($doesExist) != 0){
				echo '<script type="text/javascript">
					if (window.confirm("Customer with same name already exists! Is this a new customer? ")) {
							'.insertCustomer($fname,$lname,$addr,$phone,$conn).'
						}
				</script>';
			} else {
				insertCustomer($fname,$lname,$addr,$phone,$conn);
			}
		}
		
		function insertCustomer($fname,$lname,$addr,$phone,$conn) {
				$insert_cust_query = "INSERT into CUSTOMER (fname,lname,mailing_address,telephone) VALUES ('$fname','$lname','$addr','$phone')";
				
				$result = mysqli_query($conn,$insert_cust_query);
				if (!$result) print("Error: ".mysqli_error($conn));
				else{ 
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
									Customer Added!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
				}
		}

        CloseCon($conn);

    ?>
	<h1>Add a new article</h1>
    <form id="custData" action="" method="POST">
  <div class="form-group col-md-2">
    <label for="fname">First name</label>
    <input type="text" class="form-control" name="fname"  placeholder="First name">
  </div>
  <div class="form-group col-md-2">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" name="lname" placeholder="Last name">
  </div>
  <div class="form-group col-md-6">
    <label for="addr">Address</label>
    <input type="text" class="form-control" name="addr" placeholder="Address">
  </div>
  <div class="form-group col-md-2">
    <label for="phone">Telephone</label>
    <input type="text" class="form-control" name="phone" placeholder="Telephone">
  </div>
  <div class="row">
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>   

<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
  </body>
</html>