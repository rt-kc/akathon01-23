<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/tabicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="style/form.css">

    <script src="js/form.js"></script>
    <title>Homepage</title>
</head>

<body>
    <div class="fixbug">
        <header>


            <nav>
                <h1>TNE:GO</h1>
                <div class="nav_links">
                    <input type="checkbox" id="button">
                    <label for="button" id="nav_icon"><i class="fa-solid fa-bars"></i></label>
                    <ul>
                        <li class="active"><a href="index.php">Homepage</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="ourteam.php">Our Team</a></li>
                        <?php
                        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                            echo "<li><a href='admin.php'>Admin</a></li>";
                        }
                        if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
                            echo "<li><a href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<li><a href='login.php'>Login</a></li>";
                        }
                        ?>
                    </ul>

                </div>
            </nav>

        </header>

        <main>
            <div class="introduction_page">
                <a href="#service_introduction"><i class="fa-solid fa-chevron-down" id="down_icon"></i></a>
                <div class="intro_text animate__animated animate__fadeInRight">
                    <h1>TNE:GO</h1>
                    <p>Create your own network configuration effortlessly on the go.</p>
                    <br>
                    <a href="login.php" class="intro_btn btn1">Login</a>
                    <a href="registration.php" class="intro_btn btn2">Sign Up</a>
                </div>

            </div>

            <div class="service_introduction" id="service_introduction">
                <div class="service_content">

                    <video class="video" autoplay loop muted>
                        <source src="images/space-65881.mp4" type="video/mp4" fps="" />
                    </video>

                    <div class="service_list">
                        <h1>A peek at the service...</h1>
                        <p>Get your business connected and thriving with our top-quality devices, efficient network
                            structures, and reliable configuration work. We specialize in providing tailored network
                            solutions for businesses of all sizes.</p>
                        <p class="m-1">Here are some services that we bring you:</p>
                        <ol>
                            <li>Connect your offices</li>
                            <li>Reliable service</li>
                            <li>Security</li>
                            <li>Fast setup</li>
                            <li>Account registration</li>
                        </ol>
                    </div>

                </div>

            </div>
            <div class="open_source">
                <div class="left_logo">
                    <h1>Networking Partner</h1>
                    <img src="images/ciscologo.png" alt="cisco logo">
                </div>

                <div class="right_logo">
                    <div>
                        <h3>Source code</h3>
                        <p> <a href="https://js.cytoscape.org/">cytoscapejs</a></p>
                        <p><a href="https://cassandra.apache.org/doc/latest/cassandra/cql/">Cassandra Query Language</a></p>
                        <p><a href="https://swiperjs.com/">Swiperjs</a></p>
                        <p><a href="https://animate.style/">AnimateCSS</a></p>
                        <p><a>HTML, CSS, Javascript, PHP<a></p>
                    </div>
                </div>
            </div>

            <div class="logo_source">
                <div class="logo_container">
                    <div class="logo_image">
                        <img src="images/datastaxlogo.jpg" alt="datastaxlogo">
                        <p>Main sponsor in this program</p>
                    </div>

                    <div class="logo_image">
                        <img src="images/Picture1.png" alt="swinburnelogo">
                    </div>

                    <div class="logo_image">
                        <img src="images/akathonlogo.jpg" alt="akathonlogo">
                        <p>This project was made for Akathon</p>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <footer>
        <p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
</body>

</html>