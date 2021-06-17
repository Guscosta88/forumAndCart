<?php
 include 'ch21_include.php';
 doDB();

$category_ID = $_POST['topic'];


 //gather the topics
//  $get_categories_sql = "SELECT t.topic_id, t.topic_title,
//  DATE_FORMAT(t.topic_create_time, '%b %e %Y at %r') AS
//  fmt_topic_create_time, t.topic_owner FROM records_topics AS t
//  INNER JOIN records_categories AS c
//  ON t.category_ID = $category_ID
//  ORDER BY topic_create_time DESC";
//  $get_categories_res = mysqli_query($mysqli, $get_categories_sql)
//  or die(mysqli_error($mysqli));

$get_categories_sql = "SELECT topic_id, topic_title,
DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS
fmt_topic_create_time, topic_owner FROM records_topics
ORDER BY topic_create_time DESC";
$get_categories_res = mysqli_query($mysqli, $get_categories_sql)
or die(mysqli_error($mysqli));
 

 if (mysqli_num_rows($get_categories_res) < 1) {
 //there are no topics, so say so
 $display_block = "<p><em>No topics exist.</em></p>";
 } else {
 //create the display string
 $display_block = 
 <<<END_OF_TEXT
    <table>
    <tr>
    <th>CATEGORY TITLE</th>
    <th># of POSTS</th>
    </tr>
END_OF_TEXT;

 while ($topic_info = mysqli_fetch_array($get_categories_res)) {
 $topic_id = $topic_info['topic_id'];
 $topic_title = stripslashes($topic_info['topic_title']);
 $topic_create_time = $topic_info['fmt_topic_create_time'];
 $topic_owner = stripslashes($topic_info['topic_owner']);

 //get number of posts
 $get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM
 records_posts WHERE topic_id = ".$topic_id;
 $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql)
 or die(mysqli_error($mysqli));

 while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
 $num_posts = $posts_info['post_count'];
 
 }

 //add to display
 $display_block .= 
 <<<END_OF_TEXT
    <tr>
    <td><a href="showtopic.php?topic_id=$topic_id">
    <strong>$topic_title</strong></a><br/>
    Created on $topic_create_time by $topic_owner</td>
    <td class="num_posts_col">$num_posts</td>
    </tr>
END_OF_TEXT;
 }
 //free results
 mysqli_free_result($get_categories_res);
 mysqli_free_result($get_num_posts_res);

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
    <style type="text/css">
 table {
 border: 1px solid black;
 border-collapse: collapse;
 color: black;
 }
 th {
 border: 1px solid black;
 padding: 6px;
 font-weight: bold;
 background: #ccc;
 color:black;
 }
 td {
 border: 1px solid black;
 padding: 6px;
 color:black;
 }
.num_posts_col { text-align: center; }

</style>
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
       


<div class="category-list-content">
<div class="category-list">
<h1>Category</h1>
<?php echo $display_block; ?>

<div class="catlist-buttons">
    <div class="button-1">
<button type="submit" name="submit" value="submit"><a href="index.html#home">Back</a></button>
</div>
<div class="button-2">
<button type="submit" name="submit" value="submit"><a href="addtopic.php">add topic</a></button>
</div>
</div>

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



