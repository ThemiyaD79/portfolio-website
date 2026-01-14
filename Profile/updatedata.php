<?php
session_start();
include('connection.php');

// Simple gatekeeper
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: adminlogin.php");
    exit();
}

if(isset($_POST['update_btn']))
{
    // FORCE ID TO 1
    $id = 1;

    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    $about_me = $_POST['about_me'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // NEW: Capture the 5 specific social links
    $facebook = $_POST['link_facebook'];
    $youtube = $_POST['link_youtube'];
    $instagram = $_POST['link_instagram'];
    $linkedin = $_POST['link_linkedin'];
    $tiktok = $_POST['link_tiktok'];

    $image_name = $_FILES['profile_image']['name'];
    $image_tmp_name = $_FILES['profile_image']['tmp_name'];

    // CHECK IF IMAGE IS UPLOADED
    if($image_name != "") 
    {
        move_uploaded_file($image_tmp_name, "upload/" . $image_name);
        
        // Update Query WITH Image
        $query = "UPDATE profile_details SET 
                    full_name='$full_name', 
                    role='$role', 
                    about_me='$about_me', 
                    email='$email', 
                    phone='$phone', 
                    link_facebook='$facebook',
                    link_youtube='$youtube',
                    link_instagram='$instagram',
                    link_linkedin='$linkedin',
                    link_tiktok='$tiktok',
                    profile_image='$image_name' 
                  WHERE id=1 "; 
    } 
    else 
    {
        // Update Query WITHOUT Image
        $query = "UPDATE profile_details SET 
                    full_name='$full_name', 
                    role='$role', 
                    about_me='$about_me', 
                    email='$email', 
                    phone='$phone', 
                    link_facebook='$facebook',
                    link_youtube='$youtube',
                    link_instagram='$instagram',
                    link_linkedin='$linkedin',
                    link_tiktok='$tiktok'
                  WHERE id=1 ";
    }

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo "<script>
                alert('Success! Profile and Social Links Updated.');
                window.location.href='admin.php';
              </script>";
    }
    else
    {
        echo "<script>
                alert('Database Error: " . mysqli_error($conn) . "');
                window.location.href='admin.php';
              </script>";
    }
}
?>