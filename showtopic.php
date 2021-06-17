<?php
include 'ch21_include.php';
doDB();
//check for required info from the query string
if (!isset($_GET['topic_id'])) {
header("Location: topiclist.php");
exit;
}
//create safe values for use
$safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['topic_id']);
//verify the topic exists
$verify_topic_sql = "SELECT topic_title FROM records_topics
WHERE topic_id = '".$safe_topic_id. "'";
$verify_topic_res = mysqli_query($mysqli, $verify_topic_sql)
or die(mysqli_error($mysqli));
if (mysqli_num_rows($verify_topic_res) < 1) {
    //this topic does not exist
    $display_block = "<p><em>You have selected an invalid topic.<br/>
    Please <a href=\"topiclist.php\">try again</a>.</em></p>";
} else {
    //get the topic title
    while ($topic_info = mysqli_fetch_array($verify_topic_res)) {
    $topic_title = stripslashes($topic_info['topic_title']);
    }
    //gather the posts
    $get_posts_sql = "SELECT post_id, post_text,
    DATE_FORMAT(post_create_time,
    '%b %e %Y<br/>%r') AS fmt_post_create_time, post_owner
    FROM records_posts
    WHERE topic_id = '".$safe_topic_id."'
    ORDER BY post_create_time ASC";
    $get_posts_res = mysqli_query($mysqli, $get_posts_sql)
    or die(mysqli_error($mysqli));
    //create the display string
    $display_block = 
  <<<END_OF_TEXT
    <p>Showing posts for the <strong>$topic_title</strong> topic:</p>
    <table>
    <tr>
    <th>AUTHOR</th>
    <th>POST</th>
    </tr>
END_OF_TEXT;
    while ($posts_info = mysqli_fetch_array($get_posts_res)) {
    $post_id = $posts_info['post_id'];
    $post_text = nl2br(stripslashes($posts_info['post_text']));
    $post_create_time = $posts_info['fmt_post_create_time'];
    $post_owner = stripslashes($posts_info['post_owner']);
    //add to display
    $display_block .= <<<END_OF_TEXT
    <tr>
    <td>$post_owner<br/><br/>
    created on:<br/>$post_create_time</td>
    <td>$post_text<br/><br/>
    <a href="replytopost.php?post_id=$post_id">
    <strong>REPLY TO POST</strong></a></td>
    </tr>
END_OF_TEXT;
    }
    //free results
    mysqli_free_result($get_posts_res);
    mysqli_free_result($verify_topic_res);
    //close connection to MySQL
    mysqli_close($mysqli);
    //close up the table
    $display_block .= "</table>";
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
       

        <div class="showtopic-list-content">
<div class="showtopic-list">

<h1>Posts in Topic</h1>
<?php echo $display_block; ?>
<div class="showtopic-button">
<button type="submit" name="submit" value="submit"><a href="index.html#home">Back</a></button>
</div>
</main>

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