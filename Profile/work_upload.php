<?php
// 1. SESSION & GATEKEEPER
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: adminlogin.php");
    exit();
}

include('connection.php');

// 2. HANDLE FORM SUBMISSION (INSERT DATA)
if(isset($_POST['upload_work_btn'])){
    
    $p_name = $_POST['project_name'];
    $p_desc = $_POST['project_desc'];
    $p_link = $_POST['project_link'];
    
    // Image Handling
    $img_name = $_FILES['project_image']['name'];
    $img_tmp  = $_FILES['project_image']['tmp_name'];

    if($img_name != ""){
        move_uploaded_file($img_tmp, "upload/" . $img_name);
        
        $query = "INSERT INTO work (project_name, project_desc, project_link, project_image) 
                  VALUES ('$p_name', '$p_desc', '$p_link', '$img_name')";
        
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo "<script>alert('Work Added Successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please select an image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload New Work</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; margin: 0; padding-top: 80px; }
        
        .navbar {
            position: fixed; top: 0; width: 100%; background-color: #333; color: white;
            padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; z-index: 1000; box-sizing: border-box;
        }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 15px; border-radius: 5px; }
        .nav-links a.back-btn { background-color: #6c757d; }
        
        .container {
            background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 90%; max-width: 600px; margin: 0 auto;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        input[type="text"], textarea, input[type="file"] {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px;
        }
        textarea { height: 100px; resize: vertical; }
        
        .btn-upload {
            width: 100%; padding: 15px; background-color: #1a66ff; color: white; border: none; 
            border-radius: 5px; font-size: 16px; cursor: pointer; font-weight: bold; transition: 0.3s;
        }
        .btn-upload:hover { background-color: #0044cc; }
    </style>
</head>
<body>

    <nav class="navbar">
        <h3>Admin Panel - Works</h3>
        <div class="nav-links">
            <a href="admin.php" class="back-btn">Back to Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2>Add New Work</h2>
        
        <form action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" name="project_name" placeholder="E.g., Short Film 2024" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="project_desc" placeholder="Details about what you did..." required></textarea>
            </div>

            <div class="form-group">
                <label>Project Link (YouTube/Social)</label>
                <input type="text" name="project_link" placeholder="Paste URL here">
            </div>

            <div class="form-group">
                <label>Project Image (Big Picture)</label>
                <input type="file" name="project_image" required>
            </div>

            <button type="submit" name="upload_work_btn" class="btn-upload">Upload Work</button>

        </form>
    </div>

</body>
</html>