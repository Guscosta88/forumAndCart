
<!-- // include 'ch21_include.php';
// doDB();

// $retrieveTitle = "SELECT topic_title FROM forum_topics";
// $retrieveTitleVerify = mysqli_query($mysqli, $retrieveTitle)
// or die(mysqli_error($mysqli));

// while ($topic_retrieve = mysqli_fetch_array($retrieveTitleVerify)) {
//     $topic_title = $topic_retrieve['topic']; -->



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
                <li><a class="active" href="index.html#home">HOME</a></li>
                <li><a href="retro_records.html#retro_records">RETRO RECORDS</a></li>
                <li>
          <a href="index.php">BUY RECORDS</a>
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

    <main>







        <div class="add-topic-content">
        <div class="add-topic">

<h1>Add a Topic</h1>
<form method="post" action="do_addtopic.php">

<label for="topic">Choose a Topic:</label>
  <select name="topic" id="topic">
    <option value="1">Rock</option>
    <option value="2">Reggae</option>
    <option value="3">Rap</option>
    <option value="4">Blues</option>
    <option value="5">Jazz</option>
  </select>
  </select>
  </select>
  <br><br>

<p><label for="topic_owner">Your Email Address:</label><br/>
<input type="email" id="topic_owner" name="topic_owner" size="40"
maxlength="150" required="required" /></p>

<p><label for="topic_title">Topic Title:</label><br/>
<input type="text" id="topic_title" name="topic_title" size="40"
maxlength="150" required="required" /></p>
<p><label for="post_text">Post Text:</label><br/>
<textarea id="post_text" name="post_text" rows="8"
cols="40" ></textarea></p>

<button type="submit" name="submit" value="submit">Add Topic</button>

</form>

</div>
</div>












</main>
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
