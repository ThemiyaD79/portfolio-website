<?php 
// 1. SESSION START MUST BE FIRST
session_start();

// 2. GATEKEEPER
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: adminlogin.php");
    exit();
}

include('connection.php'); 

// Fetch data
$id = 1; 
$query = "SELECT * FROM profile_details WHERE id='$id'";
$query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0)
{
    $row = mysqli_fetch_assoc($query_run);
}
else
{
    echo "No user found with ID 1.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; margin: 0; padding-top: 70px; }
        
        .navbar {
            position: fixed; top: 0; width: 100%; background-color: #333; color: white;
            padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; z-index: 1000; box-sizing: border-box;
        }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 15px; border-radius: 5px; }
        
        /* Button Colors */
        .nav-links a.home-btn { background-color: #1a66ff; }       /* Blue */
        .nav-links a.work-btn { background-color: #17a2b8; }       /* Teal (New Button) */
        .nav-links a.logout-btn { background-color: #dc3545; }     /* Red */

        .container {
            background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 90%; max-width: 600px; margin: 20px auto;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #555; }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; 
        }
        
        .social-group { background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef; margin-bottom: 15px; }
        .social-group h4 { margin-top: 0; color: #1a66ff; margin-bottom: 15px;}
        
        .current-img { display: block; margin: 10px 0; width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd; }
        .btn-update { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background 0.3s; }
        .btn-update:hover { background-color: #218838; }
    </style>
</head>
<body>

    <nav class="navbar">
        <h3>Admin Panel</h3>
        <div class="nav-links">
            <a href="Untitled-1.php" target="_blank" class="home-btn">View Website</a>
            
            <a href="work_upload.php" class="work-btn">+ Add New Work</a>
            
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Edit Profile</h2>
        
        <form action="updatedata.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>">
            </div>

            <div class="form-group">
                <label>Role</label>
                <input type="text" name="role" value="<?php echo $row['role']; ?>">
            </div>

            <div class="form-group">
                <label>About Me</label>
                <input type="text" name="about_me" value="<?php echo $row['about_me']; ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
            </div>

            <div class="social-group">
                <h4>Social Media Links</h4>
                
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" name="link_facebook" value="<?php echo $row['link_facebook']; ?>" placeholder="Facebook URL">
                </div>

                <div class="form-group">
                    <label>YouTube</label>
                    <input type="text" name="link_youtube" value="<?php echo $row['link_youtube']; ?>" placeholder="YouTube URL">
                </div>

                <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" name="link_instagram" value="<?php echo $row['link_instagram']; ?>" placeholder="Instagram URL">
                </div>

                <div class="form-group">
                    <label>LinkedIn</label>
                    <input type="text" name="link_linkedin" value="<?php echo $row['link_linkedin']; ?>" placeholder="LinkedIn URL">
                </div>

                <div class="form-group">
                    <label>TikTok</label>
                    <input type="text" name="link_tiktok" value="<?php echo $row['link_tiktok']; ?>" placeholder="TikTok URL">
                </div>
            </div>

            <div class="form-group">
                <label>Profile Image</label>
                <?php if($row['profile_image'] != ""): ?>
                    <img src="upload/<?php echo $row['profile_image']; ?>" class="current-img">
                <?php endif; ?>
                <input type="file" name="profile_image">
            </div>

            <button type="submit" name="update_btn" class="btn-update">Update Data</button>
        </form>
    </div>

</body>
</html>