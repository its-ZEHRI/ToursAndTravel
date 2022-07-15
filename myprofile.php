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
            header("location:myprofile.php");
        }
    }
    if (isset($_POST['delete'])) {
        $resp = $obj->deletePost();
    }
    if (isset($_POST['Update-profile-image'])) {
        $resp = $obj->updateProfileImage();
    }
    if(isset($_POST['delete_profile_image'])){
        $resp = $obj->deleteProfileImage();
    }
    if (isset($_POST['change-profile-name'])) {
        $resp = $obj->updateProfileName();
    }
    if(isset($_POST['update_post'])){
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
    <style type="text/css">
        .edit-image-icon {
            position: absolute;
            bottom: -30%;
            left: 16%;
            color: red;
            cursor: pointer;

        }

        #profile_image_icons {
            position: absolute;
            top: 85%;
            left: 9.5%;
            opacity: 0;
        }

        #profile_image:hover {
            opacity: 0.5;
        }

         #profile_image:hover~#profile_image_icons {
            opacity: 1;
        }

        #profile_image_icons:hover~#profile_image {
            opacity: 0.5;
        }

        #profile_image_icons:hover {
            opacity: 1;
        }

        #profile_image_icons:hover ~ #profile_image {
            opacity: 0.5!important;
        } 
    </style>
</head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>

    <main class="pt-5">
        <!-- banner -->
        <div class="position-relative">
            <div style="background-image:url('images/13.jpg'); background-size:cover; height:15rem">
            </div>
            <img id="profile_image" src="images/<?php if ($user[0]->image == null) echo "noimage.png";
                                                else echo $user[0]->image ?>" width="210px" height="210px" alt="" class="rounded-circle" style="object-fit:cover; position:absolute; top:50%; left:5%;border:3px solid white">
            <div id="profile_image_icons" class="">
                <i class="fa-solid fa-pen-to-square text-info p-2" id="profile_image_icon" style="font-size: 30px; cursor:pointer"></i>
                
                <form action="myprofile.php" method="POST" class="d-inline">
                    <button type="submit" name="delete_profile_image" class="" style="background-color: transparent; border:none">
                        <i class="fa-solid fa-circle-minus p-2 text-danger" style="font-size: 30px; cursor:pointer"></i>
                    </button>
                    <!-- <input type="submit" id="delete_profile_image_form" class="btn btn-outline-primary" name="Update-profile-image"> -->
                </form>
            </div>
            <h2 style="position:absolute; bottom: -30%; left:20%"><?php echo $user[0]->FullName; ?></h2>
        </div>
        <!-- banner end -->

        <div style="height: 8rem;" id="post"></div>
        <div class="container px-5">
            <div class="row" id="post">
                <!-- post -->
                <div class="col-md-7 px-5">
                    <div class="card text-center">
                        <div class="card-header">Post</div>
                        <div class="card-body px-5">
                            <h5 class="card-title" id="post-title">Post Something Special</h5>
                            <form action="myprofile.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="post_id" id="post_id">
                                <div class="form-group text-left">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control " id="description" placeholder="Something...!">
                                </div>
                                <div class="form-group text-left" id="image">
                                    <label for="">Picture</label>
                                    <input type="file" name="image" onchange="validateSize(this)" class="form-control " id="" placeholder="Something...!">
                                </div>
                                <div class="text-left">
                                    <input type="submit" name="submit" id='submit_btn' value="Post" class="btn btn-outline-success px-5">
                                </div>
                            </form>
                            <small class="text-danger"><?php echo $p_resp; ?></small>
                        </div>
                        <div class="card-footer text-muted">ZEHRI</div>
                    </div>
                </div>
                <!-- post end -->
                <div class="col-md-1"></div>
                <!-- update profile -->
                <div class="col-md-4 ">
                    <div class="border bg-light rounded">
                        <h3 class="m-3">Update Profile</h3>
                        <hr>
                        <div class="p-3">
                            <!-- for user name -->
                            <form action="myprofile.php" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $user[0]->FullName ?> " id="" placeholder="Haseena...!">
                                </div>

                                <div class="text-end">
                                    <input type="submit" class="btn btn-outline-primary " name="change-profile-name" value="Update">
                                </div>
                            </form>

                            <!-- for user image -->
                            <form action="myprofile.php" method="POST" class="d-none" enctype="multipart/form-data">
                                <input type="file" name="image" class="form-control" id="change_profile_image">
                                <input type="submit" id="change_profile_form" class="btn btn-outline-primary" name="Update-profile-image">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- update profile end -->
            </div>
        </div>

        <!-- gallery -->
        <div class="container mt-5 py-5">
            <h1>Posts</h1>
            <hr class="m-0">
            <div class="container mt-5">
                <div class="row">
                    <?php foreach ($userPost as $key => $value) { ?>
                        <div class="col-md-4 parent">
                            <div class="card mb-3">
                                <div class="ratio ratio-4x3">
                                    <img class="card-img-top" src="images/<?php echo $value->p_image; ?>" style="width:100%; background-size:contain; object-fit:cover; background-position:center">
                                </div>
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Title</h5> -->
                                    <p class="card-text description"><?php echo $value->description; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form method="post" class="text-right" action="myprofile.php">
                                            <input type="hidden" name="post_id" class="post_id" value="<?php echo $value->id; ?>">
                                            <button class="btn btn-sm btn-outline-danger " type="submit" name="delete" onclick="return confirm('Are you sure you want to delete the record')">Delete Post</button>
                                        </form>
                                        <a href="#post" class="btn btn-primary edit">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- gallery end -->

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
            
            $(this).on('click', '#profile_image_icon', function() {
                $('#change_profile_image').click()
            })

            $(this).on('change', '#change_profile_image', function() {
                $('#change_profile_form').click();
            })
            $("#profile_image").mouseenter(function(){
                $('#profile_image').css('opacity','0.5')
            })
            $("#profile_image").mouseleave(function(){
                $('#profile_image').css('opacity','1')
            })
            $("#profile_image_icons").mouseenter(function(){
                $('#profile_image').css('opacity','0.5')
            })
            $("#profile_image_icons").mouseleave(function(){
                $('#profile_image').css('opacity','1')
            })
            $(this).on('click','.edit',function(event){
                var edit = $(this).parentsUntil('.parent');
                $('#post-title').text('Update Post');
                $('#post_id').val(edit.find('.post_id').val());
                $('#description').val(edit.find('.description').text());
                $('#image').addClass('d-none');
                $('#submit_btn').val('Update')
                $('#submit_btn').attr('name','update_post');
            });

           
        })
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>