<?php
    $_SESSION['username'] = "Admin";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400&family=Cormorant+Garamond:wght@500;600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="index.html" class="header-brand"></p>slzar</a>
        <nav>
            <ul>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="about.html">About Me</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <a href="Cases.html" class="header-cases">Cases</a>
        </nav>
    </header>
    <main>
        <section class="gallery-links">
        <div class="wrapper" >
        <h2>Gallery</h2>

        <div class="gallery-container">
        <?php
        include_once 'includes/dbh.inc.php';

        $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed!";
        } else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)){
                echo '  
            <a href="#">
                <div class="hello" style="background-image: url(img/gallery/'.$row["imgFullNameGallery"].');"></div>
                <h3>'.$row["titleGallery"].'</h3>
                <p>'.$row["descGallery"].'</p>
            </a>';
            }
        }
            ?>
        </div>  
        <?php
        if(isset($_SESSION['username'])){
            echo ' <div class="gallery-upload">
            <form action="includes/gallery-upload.inc.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="filename" placeholder="File name">
            <br>
            <input type="text" name="filetitle" placeholder="Image Title">
            <br>
            <input type="text" name="filedesc" placeholder="Image Description">
            <br>
            <input type="file" name="file">
            <button type="submit" name="submit">Upload</button>
            </form>
        </div>';
        }
        ?>

    </section>

    </main>
    <div class="wrapper">
    <footer>
        <ul class= "footer-links-main">
            <li><a href="#">Home</a></li>
            <li><a href="#">Cases</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">About me</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <ul class="footer-links-cases">
            <li> <p> Latest Cases </p></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Quiz App</a></li>
            <li><a href="#">Thesis</a></li>
        </ul>
        <div class="footer-sm">
        <a href="#">
            <img src="img/png-transparent-youtube-play-button-logo-computer-icons-youtube-youtube-play-button-logo-computer-icons.png" alt="youtube icon"> </a>
        <a href="#"> 
            <img src="img/facebook-social-media-icons-font-awesome-logo-button-symbol-black-and-white-glyph-cross-png-clip-art.png" alt="youtube icon"> </a>
         <a href="#"> 
            <img src="img/354-3541481_twitter-icon-transparent-background-pink-instagram-logo-clipart.png" alt="youtube icon"> </a>
        </div>
    </footer>
    </div>
</body>
</html>