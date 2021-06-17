<?php
	session_start();
	require 'config.php';

	$section_ID = $_COOKIE['PHPSESSID'];

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;

	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (product_name,section_ID, product_price,product_image,qty,
		total_price,product_code) VALUES (?,?,?,?,?,?,?)');
	    $query->bind_param('sssssss',$pname,$section_ID, $pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

	    echo '<div class="alert hideThePopUp">
		
						  <strong>Item added to your cart!</strong>
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						</div>';
						
	  } else {
	    echo '<div class="alert hideThePopUp">
		
						  <strong>Item already added to your cart!</strong>
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
						</div>';
	  }

	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  
	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	 
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
		$pqty = $_POST['pqty'];
		$pcode = $_POST['pcode'];

	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();

	}



	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];
	  


	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)
	  VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
	  $stmt->execute();

	  $sql = $conn->prepare('SELECT * FROM cart WHERE section_ID=?');
	  $sql->bind_param('s',$section_ID);
	  $sql->execute();
	  $res = $sql->get_result();
	  

	  while($row = $res->fetch_assoc()){
		$pqtys = $row['qty'];
		$pcodes = $row['product_code'];

	  $stmt2 = $conn->prepare('UPDATE inventory SET stock_quantity = stock_quantity - ? WHERE product_code=?') or die($conn->error);
	  $stmt2->bind_param('ii',$prepare_qty,$prepare_pcode);
		$prepare_qty = $pqtys;
		$prepare_pcode = $pcodes;
		$stmt2->execute();
		$stmt2->close();
	}

	
	  $stmt3 = $conn->prepare('DELETE FROM cart');
	  $stmt3->execute();
	  $data .= '<div class="text-center">
								<h1 class="thankYou">Thank You!</h1>
								<h2 class="thankYouh2">Your Order was Placed Successfully!</h2>
								<h4 >Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	  echo $data;

	
	}
?>



