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
          <a class="active" href="index.php">BUY RECORDS</a>
        </li>
        <li><a href="contact_us.html#contact_us">CONTACT US</a></li>
        <li>
          <a href="checkout.php">CHECKOUT</a>
        </li>
        <li>
          <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
                
    
            </ul>
    
            
        </nav>
    </header>
  <!-- Navbar end -->

  <!-- Displaying Products Start -->
  
    <div id="message"></div>
    <div class="flex">
      <?php
  			include 'config.php';
  			$stmt = $conn->prepare('SELECT * FROM product');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="albums">
        <div class="each-album">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
              <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
              <h5 class="card-text text-center text-danger"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?>/-</h5>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
 
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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