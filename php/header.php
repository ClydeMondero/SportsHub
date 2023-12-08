<!--Header-->
<style> <?php include '../styles/header.css'; ?> </style>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="header">
    <div class="logo-and-title">
        <a href="landing-page.php"><img src="../assets/imgs/Vulcan Logo.png" alt=""></a>
        <a href="landing-page.php"><span>VULCAN</span></a>
    </div>

    <div class="center">                
        <div class="search-bar">                                                                
                <form id="searchForm" method="post">                                        
                    <i class="fa-solid fa-magnifying-glass"></i> 
                    <input type="search" placeholder="Search" name="search" id="search" autocomplete="off">
                </form>
                <div class="search-results"></div>                                    
        </div>        

        <a href="cart.php"><div class="add-to-cart">
            <p class="cart-count">0</p>
            <i class="fa-solid fa-cart-shopping"></i>
        </div></a>
    </div>
    
    <div class="login-and-signup">
        <a href="login.php"><p>Sign In</p></a>
        <div class="line"></div>
        <a href="register.php"><p>Sign Up</p></a>
    </div>

    <div class="profile-and-logout">
        <a href="profile.php"><p>Profile</p></a>
        <div class="line"></div>
        <a href="logout.php"><p>Logout</p></a>
    </div>

    <?php
        if($loggedIn){
            echo '<style>
                .login-and-signup{display: none !important;}
            </style>';

            echo '<style>
                .profile-and-logout{display: flex !important;}
            </style>';
        } else{
            echo '<style>
                .login-and-signup{display: flex !important;}
            </style>';

            echo '<style>
                .profile-and-logout{display: none !important;}
            </style>';
        }             
        
        if(isset($_SESSION["cartSize"])){
            echo "<script>document.querySelector('.cart-count').innerHTML = ".$_SESSION["cartSize"]."</script>";
        }
    ?>
</div>   

<script>          
  $(document).ready(function(){
    $('#search').on('input', function() {
        
            var product_name = $(this).val();
            if (product_name !== "") {
                $.post("get-products.php", {product_name: product_name}, function(data) {
                    $("div.search-results").css({'display':'block'});
                    $("div.search-results").html(data);
                })
            }else{
                $("div.search-results").css({'display':'none'});
                $("div.search-results").empty();
            }              
    });        
  });    

  var prevScrollpos = window.pageYOffset;

  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    
    if (prevScrollpos > currentScrollPos) {
        document.querySelector(".header").style.top = "0";
    } else {
        document.querySelector(".header").style.top = "-100px";
    } 

    prevScrollpos = currentScrollPos;
  
  }   
</script>