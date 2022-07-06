<?php


if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) { ?>

    <header class="bg-light w-100 position-fixed px-5 py-2 mb-5" style="box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.5); z-index:222;
            background: rgb(67, 133, 175);
			background: linear-gradient(150deg, rgba(67, 133, 175, 0) 21%, rgba(67, 133, 175, 0.3) 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo ">
                <a href="index.php">Tours & Tra<span>vels News</span></a>

            </div>
            <div class="d-flex align-items-center">
                <ul class="m-0 p-0 me-4" style="list-style-type:none">
                    <li><a style="font-size: 20px; text-decoration:none " href="myprofile.php">Profile</a></li>
                </ul>
                <h5 class="m-0 me-3"><?php echo htmlentities($_SESSION['user_name']); ?></h5>
                <a style="text-decoration: none;" class="text-dark btn" href="logout.php">Logout
                    <span class="fa-solid fa-arrow-right-from-bracket"></span></a>
            </div>
        </div>
    </header>

<?php

} else { ?>

    <header class="bg-light w-100 position-fixed px-5 py-2 mb-5" style="box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.5); z-index:222">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo wow fadeInDown animated" data-wow-delay=".5s">
                <a href="index.php">Tours & Tra<span>vels News</span></a>
            </div>
            <div class="dropdown show">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="admin/index.php">Admin Login</a>
                    <a class="dropdown-item" href="includes/signup.php">Sign Up</a>
                    <a class="dropdown-item" href="includes/signin.php">Sign In</a>
                </div>
            </div>
        </div>
    </header>
<?php } ?>