<?php 
include('connection.php');
// Fetch user data
$query = "SELECT * FROM profile_details WHERE id=1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['full_name']; ?> - Portfolio</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        /* --- GLOBAL RESETS --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            /* Elegant Dark Background - Deep Charcoal/Black */
            background-color: #0a0a0a;
            /* Optional: Subtle texture overlay if you have one, otherwise pure dark elegance */
            background-image: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('back.png.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: #f0f0f0;
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        .navbar {
            position: fixed; top: 0; width: 100%; padding: 25px 60px;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(10, 10, 10, 0.8); backdrop-filter: blur(8px);
            z-index: 1000; border-bottom: 1px solid rgba(212, 175, 55, 0.2); /* Subtle Gold Line */
        }
        
        .navbar .logo { 
            font-family: 'Cinzel', serif; 
            font-size: 26px; 
            font-weight: 700; 
            color: #d4af37; /* Gold Color */
            text-transform: uppercase; 
            letter-spacing: 3px; 
        }

        .nav-links a { 
            color: #ccc; text-decoration: none; margin: 0 20px; font-size: 14px; 
            text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; 
        }
        .nav-links a:hover { color: #d4af37; }

        .login-btn {
            padding: 10px 30px; 
            background-color: transparent; 
            color: #d4af37; 
            border: 1px solid #d4af37; 
            border-radius: 0; /* Sharp edges for fashion look */
            cursor: pointer; font-family: 'Cinzel', serif; font-weight: bold; 
            transition: 0.3s; text-decoration: none; font-size: 12px;
        }
        .login-btn:hover { background-color: #d4af37; color: #000; }

        /* --- MAIN CONTAINER --- */
        .main-container { display: flex; flex-direction: column; align-items: center; padding-top: 140px; padding-bottom: 50px; }

        /* --- FASHION PROFILE CARD --- */
        .profile-card {
            display: flex;
            width: 1000px;
            background: #111; /* Matte Black */
            border: 1px solid #333;
            border-radius: 4px; /* Slight radius, mostly sharp */
            box-shadow: 0 30px 60px rgba(0,0,0,0.8); /* Deep shadow */
            animation: fadeInDown 1.5s ease;
            margin-bottom: 80px;
            z-index: 10;
            position: relative;
        }
        
        /* Gold Border Effect */
        .profile-card::before {
            content: ''; position: absolute; top: 10px; left: 10px; right: 10px; bottom: 10px;
            border: 1px solid rgba(212, 175, 55, 0.3); /* Inner Gold Border */
            pointer-events: none;
        }

        .card-left {
            width: 45%; padding: 60px;
            display: flex; justify-content: center; align-items: center;
            background: #0f0f0f;
            border-right: 1px solid #222;
        }

        .img-container {
            position: relative; width: 300px; height: 380px; /* Rectangular for Model/Fashion look */
            padding: 10px;
            border: 1px solid #d4af37; /* Gold Border */
        }
        
        .profile-img { 
            width: 100%; height: 100%; 
            object-fit: cover; 
            filter: grayscale(20%); /* Artistic touch */
            transition: 0.5s;
        }
        .img-container:hover .profile-img { filter: grayscale(0%); }

        .card-right {
            width: 55%; padding: 60px;
            display: flex; flex-direction: column; justify-content: center;
            text-align: left;
        }

        h1 { 
            font-family: 'Cinzel', serif; 
            margin: 0; font-size: 48px; color: #fff; 
            font-weight: 400; letter-spacing: 2px;
        }
        
        .role { 
            font-family: 'Montserrat', sans-serif;
            color: #d4af37; /* Gold */
            font-weight: 500; 
            margin-top: 10px; margin-bottom: 30px; 
            display: block; text-transform: uppercase; 
            letter-spacing: 4px; font-size: 14px;
        }
        
        .bio { 
            color: #aaa; line-height: 2; margin-bottom: 40px; font-size: 16px; font-weight: 300; 
            border-left: 2px solid #d4af37; padding-left: 20px;
        }
        
        .contact-info { 
            font-size: 14px; color: #ccc; display: flex; align-items: center; margin-bottom: 15px; 
            font-family: 'Montserrat', sans-serif; letter-spacing: 1px;
        }
        .contact-info i { margin-right: 20px; color: #d4af37; font-size: 14px;}

        /* Minimalist Social Icons */
        .social-icons { margin-top: 40px; }
        .social-icons a {
            display: inline-flex; justify-content: center; align-items: center;
            width: 40px; height: 40px;
            background-color: transparent;
            color: #fff;
            border: 1px solid #555;
            border-radius: 50%; margin-right: 15px; text-decoration: none; transition: 0.3s; font-size: 16px;
        }
        
        /* On hover, turn Gold */
        .social-icons a:hover { 
            border-color: #d4af37; 
            color: #d4af37; 
            transform: translateY(-3px); 
        }

        /* --- ABOUT SECTION (Fashion Editorial Style) --- */
        .about-section-wrapper {
            width: 100%;
            background-color: #0f0f0f;
            border-top: 1px solid #222;
            padding: 100px 15%;
            color: white;
            position: relative;
        }

        .about-content h2 { 
            font-family: 'Cinzel', serif;
            color: #d4af37; 
            font-size: 38px; 
            margin-bottom: 40px; 
            text-align: center;
            font-weight: 400;
        }
        
        .about-content p { 
            font-size: 18px; line-height: 2; color: #bbb; 
            text-align: center; max-width: 800px; margin: 0 auto 60px auto; font-weight: 300;
        }

        /* Aesthetic Highlights */
        .highlights { 
            display: flex; justify-content: center; gap: 60px; margin-top: 30px; flex-wrap: wrap;
        }
        .highlight-item { 
            display: flex; flex-direction: column; align-items: center; text-align: center; 
            width: 200px;
        }
        .highlight-item i { 
            font-size: 32px; color: #d4af37; margin-bottom: 20px; 
        }
        .highlight-text strong { 
            display: block; font-family: 'Cinzel', serif; font-size: 18px; color: #fff; margin-bottom: 5px;
        }
        .highlight-text span { 
            font-size: 12px; color: #666; text-transform: uppercase; letter-spacing: 1px;
        }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Sudda</div>
        <div class="nav-links">
            <a href="#">Portfolio</a>
            <a href="#about">The Brand</a>
            <a href="work.php">Collections</a>
            <a href="#">Contact</a>
        </div>
        <a href="adminlogin.php" class="login-btn">Admin Access</a>
    </nav>

    <div class="main-container">

        <div class="profile-card">
            <div class="card-left">
                <div class="img-container">
                    <?php 
                        if($row['profile_image'] != "") {
                            echo '<img src="upload/'.$row['profile_image'].'" class="profile-img">';
                        } else {
                            // Placeholder fashion sketch image if none exists
                            echo '<img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1000&auto=format&fit=crop" class="profile-img">';
                        }
                    ?>
                </div>
            </div>

            <div class="card-right">
                <h1><?php echo $row['full_name']; ?></h1>
                <span class="role"><?php echo $row['role']; ?></span> <p class="bio">"<?php echo $row['about_me']; ?>"</p>
                
                <div class="contact-info"><i class="fa-solid fa-envelope"></i> <?php echo $row['email']; ?></div>
                <div class="contact-info"><i class="fa-solid fa-phone"></i> <?php echo $row['phone']; ?></div>

                <div class="social-icons">
                    <?php if(!empty($row['link_facebook'])): ?><a href="<?php echo $row['link_facebook']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a><?php endif; ?>
                    <?php if(!empty($row['link_youtube'])): ?><a href="<?php echo $row['link_youtube']; ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a><?php endif; ?>
                    <?php if(!empty($row['link_instagram'])): ?><a href="<?php echo $row['link_instagram']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a><?php endif; ?>
                    <?php if(!empty($row['link_linkedin'])): ?><a href="<?php echo $row['link_linkedin']; ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a><?php endif; ?>
                    <?php if(!empty($row['link_tiktok'])): ?><a href="<?php echo $row['link_tiktok']; ?>" target="_blank"><i class="fa-brands fa-tiktok"></i></a><?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="about-section-wrapper" id="about">
        <div class="about-content">
            <h2>The Art of Design</h2>
            <p>
                Fashion is more than just clothing; it is a visual language. 
                With a focus on sustainable luxury and avant-garde silhouettes, 
                I create designs that empower and inspire. Every stitch tells a story of elegance, precision, and modern art.
            </p>

            <div class="highlights">
                <div class="highlight-item">
                    <i class="fa-solid fa-pen-nib"></i>
                    <div class="highlight-text">
                        <strong>Illustration</strong>
                        <span>Sketching & Concept Art</span>
                    </div>
                </div>

                <div class="highlight-item">
                    <i class="fa-solid fa-scissors"></i>
                    <div class="highlight-text">
                        <strong>Textile Design</strong>
                        <span>Fabric & Pattern Making</span>
                    </div>
                </div>

                <div class="highlight-item">
                    <i class="fa-solid fa-camera-retro"></i>
                    <div class="highlight-text">
                        <strong>Creative Direction</strong>
                        <span>Styling & Visuals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>