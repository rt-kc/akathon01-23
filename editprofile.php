<?php
//if logged in, go to manager page
	session_start();

	if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {

	}else{
		header('Location: ./login.php');
	}
    
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows/";
    $token = "AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Accept: application/json",
        "X-Cassandra-Token: $token"
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	    <link rel="icon" href="images/tabicon.png">
        <link rel="stylesheet" href="style/animation.css">
        <link rel="stylesheet" href="style/form.css">
        <link
        rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <title>Edit Profile</title>

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
                        <li ><a href="index.php">Homepage</a></li>
                        <li><a href="Dashboard.php">Dashboard</a></li>
                        <li ><a href="ourteam.php">Our Team</a></li>
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
            <div class="login_space">
                <form action="upload.php" method="POST" class="animate__animated animate__fadeInRight">
                    <div class="loginform registrationform">
                        <h1>Edit Your Profile</h1>
                        <form method="post" action="authentication.php" id="registered_form">
                            <div class="registration_container">

                                <div class="left_registration">
                                    <div class="input_field">
                                        <input type="text" name="fname" id="fname" required autocomplete="off" value="<?= $_SESSION['row']->firstname ?>">
                                        <span></span>
                                        <label for="fname">Firstname:</label>
                                    </div>
                                    
                                    <div class="input_field">
                                        <input type="text" name="email" id="email" required autocomplete="off" value="<?= $_SESSION['row']->email ?>">
                                        <span></span>
                                        <label for="email">Email:</label>
                                    </div>

                                    <div class="input_field">
                                        <input type="password" name="password" id="password" autocomplete="off" >
                                        <span></span>
                                        <label for="password">Current password:</label>
                                    </div>
                                    
                                    <div class="input_field">
                                        <input type="password" name="repassword" id="repassword"  autocomplete="off" >
                                        <span></span>
                                        <label for="repassword">Retype your new password:</label>
                                    </div>
                                </div>

                                <div class="right_registration">
                                    <div class="input_field">
                                        <input type="text" name="lname" id="lname" required autocomplete="off" value="<?= $_SESSION['row']->lastname ?>">
                                        <span></span>
                                        <label for="lname">Lastname:</label>
                                    </div>
                                    
                                    <div class="input_field">
                                        <input type="tel" name="phone" id="phone" required autocomplete="off" value="<?= $_SESSION['row']->phone?>">
                                        <span></span>
                                        <label for="phone">Phone number:</label>
                                    </div>
    
                                    <div class="input_field">
                                        <input type="password" name="newpassword" id="newpassword"  autocomplete="off" >
                                        <span></span>
                                        <label for="newpassword">New password:</label>
                                    </div>
    
                                </div>
                            </div>

                            <input type="submit" value="Save changes">

                        </form>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <footer>
        <p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
    
    <script src="js/animation.js"></script>
    
</body>
</html>

