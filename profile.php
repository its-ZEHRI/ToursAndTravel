<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");

include('processor/get_processor.php');
$p_resp = "";
if (isset($_POST['submit'])) {
    $p_resp = $obj->addPost();
    if ($p_resp == "ok") {
        header("location:profile.php");
    }
}
if (isset($_POST['delete'])) {
    $resp = $obj->deletePost();
}
if (isset($_POST['Update-profile-image'])) {
    $resp = $obj->updateProfileImage();
}
if (isset($_POST['delete_profile_image'])) {
    $resp = $obj->deleteProfileImage();
}
if (isset($_POST['change-profile-name'])) {
    $resp = $obj->updateProfileName();
}
if (isset($_POST['update_post'])) {
    $resp = $obj->updatePost();
}
$user = $obj->getUser();
$userPost = $obj->getUserPost();
?>
<!DOCTYPE HTML>
<html style="scroll-behavior: smooth;">

<head>
    <title>TMS | Package List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!-- Custom Theme files -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/068fbca468.js" crossorigin="anonymous"></script>
    <!--//end-animate-->
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/custom.css">
    </head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>

    <main class="container-fluid">
        <div id="posts" class="row" style="margin-top: 5rem;">
            <div id="column" class="col-md-3 d-none"></div>
            <!--  side bar -->
            <div id="profile_side" class="col-md-3">
                <?php include('sidebar.php'); ?>
            </div>
            <!-- Profile -->
            <div class="col-md-9">
                <!-- banner -->
                <div class="position-relative user-profile">
                    <div class="bg-image" style="background-image:url('images/13.jpg'); background-size:cover; height:15rem">
                    </div>
                    <img id="profile_image" src="images/<?php if ($user[0]->image == null) echo "noimage.png";
                                                        else echo $user[0]->image ?>" width="210px" height="210px" alt="" class="rounded-circle" style="object-fit:cover; position:absolute; top:50%; left:5%;border:3px solid white">
                    <div id="profile_image_icons" class="">
                        <i class="fa-solid fa-pen-to-square text-info p-2" id="profile_image_icon" style="font-size: 30px; cursor:pointer"></i>

                        <form action="profile.php" method="POST" class="d-inline">
                            <button type="submit" name="delete_profile_image" class="" style="background-color: transparent; border:none">
                                <i class="fa-solid fa-circle-minus p-2 text-danger" style="font-size: 30px; cursor:pointer"></i>
                            </button>
                        </form>
                        <form action="profile.php" method="POST" class="d-none" enctype="multipart/form-data">
                                <input type="file" name="image" class="form-control" id="change_profile_image">
                                <input type="submit" id="change_profile_form" class="btn btn-outline-primary" name="Update-profile-image">
                            </form>
                    </div>
                    <h2 style="position:absolute; bottom: -30%; left:25%"><?php echo $user[0]->FullName; ?></h2>
                </div>
                <!-- Post -->
                <div style="height: 8rem;" id="post"></div>
                <div class="container  mb-5 px-lg-5">
                    <div class="row mb-5 px-lg-5" id="pos">
                        <div class="col-md-12 mb-4 mb-lg-0">
                            <div class="card text-center">
                                <div class="card-header">Post</div>
                                <div class="card-body px-lg-5">
                                    <h5 class="card-title" id="post-title">Post Something Special</h5>
                                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="post_id" id="post_id">
                                        <div class="form-group text-left">
                                            <label for="">Description</label>
                                            <input type="text" name="description" class="form-control " id="description" placeholder="Something...!">
                                        </div>
                                        <div class="form-group text-left" id="image">
                                            <label for="">Picture</label>
                                            <input type="file" name="image" onchange="validateSize(this)" class="form-control " id="" placeholder="Something...!">
                                        </div>
                                        <div class="text-end btn-wrapper">
                                            <input type="submit" name="submit" id='submit_btn' value="Post" style="padding:8px 30px" class="custom-btn">
                                        </div>
                                    </form>
                                    <small class="text-danger"><?php echo $p_resp; ?></small>
                                </div>
                                <div class="card-footer text-muted">ZEHRI</div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-lg-5">
                        <h1>Posts</h1>
                        <?php foreach ($userPost as $key => $value) { ?>
                            <div class="col-md-6 parentt">
                                <div class="card mb-3 m-3">
                                    <div class="ratio ratio-4x3">
                                        <img class="card-img-top" src="images/<?php echo $value->p_image; ?>" style="width:100%; background-size:contain; object-fit:cover; background-position:center">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text description"><?php echo $value->description; ?></p>
                                        <div class="d-flex justify-content-between btn-wrapper align-items-center">
                                            <form method="post" class="text-right" action="profile.php">
                                                <input type="hidden" name="post_id" class="post_id" value="<?php echo $value->id; ?>">
                                                <button class="custom-delete-btn" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete the record')">Delete Post</button>
                                            </form>
                                            <a href="#post" class="custom-btn edit">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

    </main>

    <script>
        function validateSize(input) {
            const fileSize = input.files[0].size // in MiB
            if (fileSize > 7097152) {
                alert('File size exceeds 7 MiB');
                // $(file).val(''); //for clearing with Jquery
            } else {
                // Proceed further
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // for fixed column of row
            $(window).scroll(function() {
                var height = $(window).scrollTop();
                if (height > 10) {
                    $('#profile_side').addClass('prfile-fixed')
                    $('#column').removeClass('d-none')
                } else {
                    $('#profile_side').removeClass('prfile-fixed')
                    $('#column').addClass('d-none')

                }
            });

            $(this).on('click', '#profile_image_icon', function() {
                $('#change_profile_image').click()
            })

            $(this).on('change', '#change_profile_image', function() {
                $('#change_profile_form').click();
            })
            $("#profile_image").mouseenter(function() {
                $('#profile_image').css('opacity', '0.5')
            })
            $("#profile_image").mouseleave(function() {
                $('#profile_image').css('opacity', '1')
            })
            $("#profile_image_icons").mouseenter(function() {
                $('#profile_image').css('opacity', '0.5')
            })
            $("#profile_image_icons").mouseleave(function() {
                $('#profile_image').css('opacity', '1')
            })
            $(this).on('click', '.edit', function(event) {
                var edit = $(this).parentsUntil('.parentt');
                $('#post-title').text('Update Post');
                $('#post_id').val(edit.find('.post_id').val());
                $('#description').val(edit.find('.description').text());
                $('#image').addClass('d-none');
                $('#submit_btn').val('Update')
                $('#submit_btn').attr('name', 'update_post');
            });


        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

</body>

</html>