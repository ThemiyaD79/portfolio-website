<?php 
include('connection.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Works</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

        body {
            /* Same Background as Home */
            background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('back.png.png');
            background-size: cover; background-position: center; background-attachment: fixed;
            min-height: 100vh; color: #333; padding-top: 100px;
        }

        /* NAVBAR */
        .navbar {
            position: fixed; top: 0; width: 100%; padding: 20px 50px;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            z-index: 1000; border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .navbar .logo { font-size: 24px; font-weight: bold; color: white; text-transform: uppercase; letter-spacing: 2px; }
        .nav-links a { color: white; text-decoration: none; margin: 0 15px; font-size: 16px; transition: 0.3s; }
        .nav-links a:hover { color: #1a66ff; }

        /* CONTAINER */
        .work-container {
            width: 1000px; margin: 0 auto; display: flex; flex-direction: column; gap: 40px; padding-bottom: 50px;
        }

        .page-title {
            text-align: center; color: white; font-size: 40px; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 3px;
        }

        /* WORK CARD DESIGN */
        .work-card {
            display: flex; background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); transition: transform 0.3s;
            height: 350px; /* Fixed height for consistency */
        }
        
        .work-card:hover { transform: translateY(-5px); }

        /* Left: BIG IMAGE */
        .work-img {
            width: 50%; 
            overflow: hidden;
        }
        .work-img img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;
        }
        .work-card:hover .work-img img { transform: scale(1.05); }

        /* Right: DETAILS */
        .work-details {
            width: 50%; padding: 40px; display: flex; flex-direction: column; justify-content: center;
        }

        .work-details h2 { font-size: 28px; color: #1a66ff; margin-bottom: 15px; }
        .work-details p { color: #555; line-height: 1.6; font-size: 16px; margin-bottom: 25px; flex-grow: 1; overflow: hidden; }

        .btn-link {
            align-self: flex-start;
            padding: 10px 25px; background-color: #333; color: white; text-decoration: none;
            border-radius: 50px; font-weight: bold; transition: 0.3s; display: inline-flex; align-items: center;
        }
        .btn-link i { margin-right: 8px; }
        .btn-link:hover { background-color: #1a66ff; }

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">PORTFOLIO</div>
        <div class="nav-links">
            <a href="Untitled-1.php">Home</a>
            <a href="work.php" style="color: #1a66ff;">Works</a>
            <a href="#">Contact</a>
        </div>
    </nav>

    <div class="work-container">
        <h1 class="page-title">My Projects</h1>

        <?php
        // FETCH DATA FROM DATABASE
        $query = "SELECT * FROM work ORDER BY id DESC"; // Newest first
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
                ?>
                <div class="work-card">
                    <div class="work-img">
                        <img src="upload/<?php echo $row['project_image']; ?>" alt="Project Image">
                    </div>
                    <div class="work-details">
                        <h2><?php echo $row['project_name']; ?></h2>
                        <p><?php echo $row['project_desc']; ?></p>
                        
                        <?php if($row['project_link'] != ""): ?>
                            <a href="<?php echo $row['project_link']; ?>" target="_blank" class="btn-link">
                                <i class="fa-solid fa-link"></i> View Project
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        }
        else
        {
            echo "<h3 style='color:white; text-align:center;'>No works added yet.</h3>";
        }
        ?>

    </div>

</body>
</html>