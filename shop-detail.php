<?php
require 'config/dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biplob K. Mondol</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

    <link id="default-css" rel="stylesheet" href="style.css" type="text/css" media="all"/>

    <link href="css/animations.css" rel="stylesheet" type="text/css" media="all"/>
    <link id="shortcodes-css" href="css/shortcodes.css" rel="stylesheet" type="text/css" media="all"/>
    <link id="skin-css" href="skins/red/style.css" rel="stylesheet" media="all"/>
    <link href="css/isotope.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
    <link href="css/pace.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all"/>
    <script src="js/modernizr.js"></script>
    <link id="light-dark-css" href="dark/dark.css" rel="stylesheet" media="all"/>

    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css"/>
</head>
<body>
<div class="loader-wrapper">
    <div id="large-header" class="large-header">

        <h1 class="loader-title"><img src="images/assets/preloder.png"><br><img src="images/assets/please.gif"
                                                                                height="50px"> </span> </h1>
    </div>
</div>

<div class="wrapper">
    <div class="inner-wrapper">
        <div id="header-wrapper" class="dt-sticky-menu">
            <div id="header" class="header">
                <div class="container menu-container">
                    <a class="logo" href="index.html"><img alt="Logo" src="images/assets/logo-final.png"></a>
                    <a href="#" class="menu-trigger">
                        <span></span>
                    </a>
                </div>
            </div>
            <nav id="main-menu">
                <div id="dt-menu-toggle" class="dt-menu-toggle">
                    Menu
                    <span class="dt-menu-toggle-icon"></span>
                </div>
                <ul class="menu type1">
                    <li class="current_page_item menu-item-simple-parent"><a href="index.html">Home <span
                                    class="fa fa-home"></span></a>
                    </li>
                    <li class="menu-item-simple-parent">
                        <a href="about.html">About ME<span class="fa fa-user-secret"></span></a>
                    </li>
                    <li class="menu-item-simple-parent">
                        <a href="shop-detail.php">Shop<span class="fa fa-cart-plus"></span></a>
                    </li>
                    <li class="menu-item-simple-parent">
                        <a href="contact.html">Contact ME<span class="fa fa-map-marker"></span></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div id="main">
            <div class="breadcrumb">
                <div class="container">
                    <h2>Shop</h2>
                    <div class="user-summary">
                        <div class="account-links">
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                        <div class="cart-count">
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $sel = $con->query("select * from product order by product_id asc limit 1");
            if (isset($_GET['product_id'])) {
                $sel = $con->query("select * from product where product_id={$_GET['product_id']} order by product_id asc limit 1");
            }
            $product_id = '';
            $product_image = '';
            $product_price = '';
            $product_upload_date = '';
            $product_status = '';
            $product_name = '';
            $product_description = '';

            while ($row = $sel->fetch_assoc()) {

                $product_id = $row['product_id'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
                $product_upload_date = $row['product_upload_date'];
                $product_name = $row['product_name'];
                $product_status = $row['product_status'];
                $product_description = $row['product_description'];

            } ?>
            <section id="primary" class="content-full-width">
                <div class="container">
                    <div class="main-title animate" data-animation="pullDown" data-delay="100">
                        <h3> <?php echo $product_name; ?> </h3>
                    </div>
                    <div class="cart-wrapper">
                        <div class="dt-sc-three-fifth column first">
                            <div class="cart-thumb">
                                <a href="#">
                                    <img src="product/<?php echo $product_image; ?> " alt="" title="Acrylic">
                                </a>
                            </div>
                            <h4 style="color: #a81c51;">Starting price: $<?php echo $product_price; ?></h4>
                            <h5>Image Description</h5>
                            <div class="author-desc">
                                <p><?php echo $product_description; ?></p>
                                <br>
                            </div>

                            <div class="commententries">
                                <h4> Bids (
                                    <?php $sel = $con->query("select * from buyer where product_id='$product_id' order by buyer_id desc");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        $i++;
                                    }
                                    echo $i;
                                    ?>) </h4>
                                <h6><a href="#"><i class="fa fa-comments-o"></i>Add Bids</a></h6>
                                <div id="recaptcha-container" style="margin-bottom: 20px; margin-top: 50px"></div>
                                <input type="text" placeholder="Number" id="buyer_number"
                                       style="margin-bottom: 10px;max-width: 87%;float: left"/>
                                <button class="button" style="margin-left: -4px" onclick="phoneAuth();">Send OTP
                                </button>
                                <div id="comment-section-d" style="display: none;">
                                    <br>
                                    <input type="text" placeholder="OTP" id="verificationCode"
                                           style="margin-bottom: 10px"/>
                                    <input type="hidden" id="product_id" value="<?php echo $product_id; ?>"
                                           style="margin-bottom: 10px"/>
                                    <br>
                                    <input type="text" placeholder="Name" id="buyer_name" style="margin-bottom: 10px"/>
                                    <br>
                                    <input type="text" placeholder="Bids Price" id="buyer_bid_price"
                                           style="margin-bottom: 10px"/>
                                    <button class="button" onclick="codeverify();">Add BID</button>
                                </div>
                                <ul class="commentlist">
                                    <?php
                                    $sel = $con->query("select * from buyer where product_id='$product_id' order by buyer_id desc");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        if ($i == 0) {
                                            ?>
                                            <li>
                                                <div class="comment">
                                                    <header class="comment-author">
                                                        <img title="" alt="image"
                                                             src="product/vector60-2249-01.jpg">
                                                    </header>
                                                    <div class="comment-details">
                                                        <div class="author-name">
                                                            <a href="#"><?php echo $row['buyer_name']; ?></a>
                                                        </div>
                                                        <div class="commentmetadata"><span
                                                                    class="fa fa-calendar"></span><?php
                                                            echo date('d M, Y', strtotime($row['buyer_bid_date_time']));
                                                            ?>
                                                        </div>
                                                        <div class="comment-body">
                                                            <div class="comment-content">
                                                                <p>$ <?php echo $row['buyer_bid_price']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        } else {
                                            ?>
                                            <li>
                                                <div class="comment">
                                                    <header class="comment-author">
                                                        <br>
                                                        <img title="" alt="image"
                                                             src="product/vector60-2249-01.jpg">
                                                    </header>
                                                    <div class="comment-details">
                                                        <br>
                                                        <div class="author-name">
                                                            <a href="#"><?php echo $row['buyer_name']; ?></a>
                                                        </div>
                                                        <div class="commentmetadata"><span
                                                                    class="fa fa-calendar"></span><?php
                                                            echo date('d M, Y', strtotime($row['buyer_bid_date_time']));
                                                            ?>
                                                        </div>
                                                        <div class="comment-body">
                                                            <div class="comment-content">
                                                                <p>$ <?php echo $row['buyer_bid_price']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php }
                                        $i++;
                                    } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="dt-sc-two-fifth column">
                            <ul class="cart-thumb-categories">
                                <?php
                                $sel = $con->query("select * from product order by product_id desc");
                                $product_image = '';
                                $product_price = '';
                                $product_upload_date = '';
                                $product_status = '';
                                $product_name = '';
                                $product_description = '';
                                $product_id_new = '';

                                $i = 1;

                                while ($row = $sel->fetch_assoc()) {
                                    $product_id_new = $row['product_id'];
                                    $product_image = $row['product_image'];
                                    $product_price = $row['product_price'];
                                    $product_upload_date = $row['product_upload_date'];
                                    $product_name = $row['product_name'];
                                    $product_status = $row['product_status'];
                                    $product_description = $row['product_description'];
                                    if ($i % 3 != 0) {
                                        ?>
                                        <li>
                                            <a href="shop-detail.php?product_id=<?php echo $product_id_new; ?>" class="product"><img src="product/<?php echo $product_image; ?>"
                                                                             alt="" title=""></a>
                                            <div class="category-details">
                                                <h6>
                                                    <a href="shop-detail.php?product_id=<?php echo $product_id_new; ?>"> <?php echo $product_name; ?> </a>
                                                </h6>
                                                <span> $<?php echo $product_price; ?> </span>
                                            </div>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="last">
                                            <a href="shop-detail.php?product_id=<?php echo $product_id; ?>"
                                               class="product"><img src="product/<?php echo $product_image; ?>"
                                                                    alt="" title=""></a>
                                            <div class="category-details">
                                                <h6><a href="shop-detail.php?product_id=<?php echo $product_id_new; ?>"> <?php echo $product_name; ?> </a></h6>
                                                <span> $<?php echo $product_price; ?> </span>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    $i++;

                                } ?>
                            </ul>
                            <div class="project-details">
                                <ul class="client-details">
                                    <li>
                                        <p><span>Title :</span>Lonely in Rain</p>
                                    </li>
                                    <li>
                                        <p><span>Artist :</span>Jamie Fox</p>
                                    </li>
                                    <li>
                                        <p><span>Category :</span>Acrylic Painting</p>
                                    </li>
                                    <li>
                                        <p><span>Description :</span>This reminds me a gorgeous moments.</p>
                                    </li>
                                    <li>
                                        <p><span>Uploaded :</span>Nov 9th, 2014 </p>
                                    </li>
                                    <li>
                                        <p><span>Statistics :</span><i class="fa fa-eye"></i>2,318</p>
                                    </li>
                                    <li>
                                        <p><span>Colors :</span><a href="#" class="yellow"></a><a href="#"
                                                                                                  class="green"></a><a
                                                    href="#" class="orange"></a><a href="#" class="red"></a></p>
                                    </li>
                                    <li>
                                        <p><span>Sales Sheet :</span>PDF</p>
                                    </li>
                                    <li>
                                        <p>
                                            <span>Tags :</span>
                                        <div class="tagcloud type3">
                                            <a href="#">Sketches</a>
                                            <a href="#">Fashion</a>
                                            <a href="#">Art</a>
                                            <a href="#">Rain</a>
                                            <a href="#">Scupture</a>
                                            <a href="#">Lonely</a>
                                            <a href="#">Oil color</a>
                                            <a href="#">Gallery</a>
                                            <a href="#">Mordern Art</a>
                                        </div>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer id="footer" class="animate" data-animation="fadeIn" data-delay="100">
                <div class="container">
                    <div class="copyright">
                        <ul class="footer-links">
                            <li><a href="contact.html">Contact ME</a></li>
                            <li><a href="about.html">About ME</a></li>
                        </ul>
                        <ul class="payment-options">
                            <li class="twitter"><a href="https://www.deviantart.com/biplobkmondol"> <i
                                            class="fa fa-deviantart"></i> </a></li>
                            <li class="twitter"><a href="https://www.pinterest.com/biplobkmondol"> <i
                                            class="fa fa-pinterest-p"></i> </a></li>
                            <li class="twitter"><a href="http://www.behance.net/biplobkmondol"> <i
                                            class="fa fa-behance"></i> </a></li>
                            <li class="twitter"><a href="https://www.instagram.com/biplobkmondol/"> <i
                                            class="fa fa-instagram"></i> </a></li>
                            <li class="twitter"><a href="https://biplobkmondol.tumblr.com/"> <i
                                            class="fa fa-tumblr"></i> </a></li>
                            <li class="facebook"><a href="https://www.facebook.com/biplobkmondol"> <i
                                            class="fa fa-facebook"></i> </a></li>
                            <li class="twitter"><a href="https://twitter.com/biplobkmondol"> <i
                                            class="fa fa-twitter"></i> </a></li>
                            <li class="twitter"><a href="https://www.linkedin.com/in/biplobkmondol/"> <i
                                            class="fa fa-linkedin"></i> </a></li>
                            <li class="dribbble"><a href="https://dribbble.com/biplobkmondol"> <i
                                            class="fa fa-dribbble"></i> </a></li>
                        </ul>
                        <p>© 2021 &nbsp <a href="#">Biplob K Mondol</a>. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyCEuA6yppw3Dcp3JD6fm2dIFJSi-5hjAbI",
        authDomain: "fir-web-b823f.firebaseapp.com",
        databaseURL: "https://fir-web-b823f.firebaseio.com",
        projectId: "biplob-k-mondol-website",
        storageBucket: "fir-web-b823f.appspot.com",
        messagingSenderId: "463332404757",
        appId: "1:463332404757:web:68d04d3fdeeb333f"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>


<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.perfectmasonry.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<script src="js/jsplugins.js" type="text/javascript"></script>
<script src="js/controlpanel.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="NumberAuthentication.js" type="text/javascript"></script>
</body>
</html>
