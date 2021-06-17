<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="stylesRecords2.css">

    <title>RETRO RECORDS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script rel="stylesheet" src="https://kit.fontawesome.com/02cd875fbf.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="wrapper">
    <header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fa fa-record-vinyl"></i>
            </label>
    
            <label class="logo"><a href="index.html#home"><img src="images/retroRecordsNewtown_logo.png" width="120"
                        height="50" alt="retroRecordsNewtown_logo" title="header-image"></a></label>
            <ul id="nav_ul">
                <li><a href="index.html#home">HOME</a></li>
                <li><a href="retro_records.html#retro_records">RETRO RECORDS</a></li>
                <li>
          <a href="index.php">BUY RECORDS</a>
        </li>
        <li><a href="contact_us.html#contact_us">CONTACT US</a></li>
        <li>
          <a href="checkout.php">CHECKOUT</a>
        </li>
        <li>
          <a class="active" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
                
    
            </ul>
    
            
        </nav>
    </header>

  <div class="order-details">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert hideThePopUp">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');">
                  <i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                $stmt = $conn->prepare('SELECT * FROM cart');
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                <td><?= $row['product_name'] ?></td>
                <td>
                  <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                </td>
                <td><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                <td>
                  <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');">
                  <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="3">
                  <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
<footer>
        <ul class="footer-container">
            <li>
                <p>© Retro Records Newtown Pty Limited 2021</p>
            </li>
            <li><a href="#facebook"><img src="images/facebook_small.png" alt="facebook" title="facebook"></a></li>
            <li><a href="#twitter"><img src="images/twitter_small.png" alt="twitter" title="twitter"></a></li>
            <li><a href="#youtube"><img src="images/youtube-variation_small.png" alt="youtube" title="youtube"></a></li>
            <li>
                <p>All Rights Reserved. info@retrorecordsnewtown.com.au </p>
            </li>
        </ul>
    </footer>
    </div>
</body>

</html>