 <?php
 include 'ch21_include.php';
 doDB();

 //check to see if we’re showing the form or adding the post
 if (!$_POST) {
 // showing the form; check for required item in query string
 if (!isset($_GET['post_id'])) {
 header("Location: topiclist.php");
 exit;
 }

 //create safe values for use
$safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

 //still have to verify topic and post
 $verify_sql = "SELECT ft.topic_id, ft.topic_title FROM records_posts
 AS fp LEFT JOIN records_topics AS ft ON fp.topic_id =
 ft.topic_id WHERE fp.post_id = '".$safe_post_id."'";

 $verify_res = mysqli_query($mysqli, $verify_sql)
 or die(mysqli_error($mysqli));

 if (mysqli_num_rows($verify_res) < 1) {
 //this post or topic does not exist
 header("Location: topiclist.php");
 exit;
 } else {
 //get the topic id and title
 while($topic_info = mysqli_fetch_array($verify_res)) {
 $topic_id = $topic_info['topic_id'];
 $topic_title = stripslashes($topic_info['topic_title']);
 }
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





    <div class="replytopost-content">
<div class="replytopost">

 <h1>Post Your Reply in <?php echo $topic_title; ?></h1>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <p><label for="post_owner">Your Email Address:</label><br/>
 <input type="email" id="post_owner" name="post_owner" size="40"
 maxlength="150" required="required"></p>
 <p><label for="post_text">Post Text:</label><br/>
 <textarea id="post_text" name="post_text" rows="8" cols="40"
 required="required"></textarea></p>
 <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
 <button type="submit" name="submit" value="submit">Add Post</button>
 </form>

 

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
 <?php
 }
 //free result
 mysqli_free_result($verify_res);

 //close connection to MySQL
 mysqli_close($mysqli);

 } else if ($_POST) {
 //check for required items from form
 if ((!$_POST['topic_id']) || (!$_POST['post_text']) ||
 (!$_POST['post_owner'])) {
 header("Location: topiclist.php");
 exit;
 }

 //create safe values for use
 $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
 $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
 $safe_post_owner = mysqli_real_escape_string($mysqli, $_POST['post_owner']);

 //add the post
 $add_post_sql = "INSERT INTO records_posts (topic_id,post_text,
 post_create_time,post_owner) VALUES
 ('".$safe_topic_id."', '".$safe_post_text."',
 now(),'".$safe_post_owner."')";
 $add_post_res = mysqli_query($mysqli, $add_post_sql)
 or die(mysqli_error($mysqli));

 //close connection to MySQL
 mysqli_close($mysqli);

 //redirect user to topic
 header("Location: showtopic.php?topic_id=".$_POST['topic_id']);
 exit;
 }
?>