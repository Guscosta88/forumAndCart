<?php
include 'ch21_include.php';
doDB();

//check for required fields from the form
if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) ||
(!$_POST['post_text'])) {
header("Location: addtopic.html");
exit;
}

//create safe values for input into the database
$clean_topic_owner = mysqli_real_escape_string($mysqli,
$_POST['topic_owner']);
$clean_topic_title = mysqli_real_escape_string($mysqli,
$_POST['topic_title']);
$clean_post_text = mysqli_real_escape_string($mysqli,
$_POST['post_text']);
$category_ID = $_POST['topic'];




//create and issue the first query
$add_topic_sql = "INSERT INTO records_topics
(topic_title, topic_create_time, topic_owner, category_ID)
VALUES ('".$clean_topic_title ."', now(),
'".$clean_topic_owner."', '".$category_ID."')";

$add_topic_res = mysqli_query($mysqli, $add_topic_sql)
or die(mysqli_error($mysqli));

//get the id of the last query
$topic_id = mysqli_insert_id($mysqli);

//create and issue the second query
$add_post_sql = "INSERT INTO records_posts
(topic_id, post_text, post_create_time, post_owner)
VALUES ('".$topic_id."', '".$clean_post_text."',
now(), '".$clean_topic_owner."')";

$add_post_res = mysqli_query($mysqli, $add_post_sql)
or die(mysqli_error($mysqli));
//close connection to MySQL
mysqli_close($mysqli);

//create nice message for user
$display_block = "<p>The <strong>".$_POST["topic_title"]."</strong>
topic has been created.</p>";
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
<h1>New Topic Added</h1>
<?php echo $display_block; ?>
<button type="submit" name="submit" value="submit"><a href="index.html#home">Back</a></button>
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