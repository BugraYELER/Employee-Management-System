<?php 
// session_set_cookie_params($time),$path,$domain,$secure(https),$httpOnly);
session_set_cookie_params(null,'/','localhost',false,true);
require_once("Require.php");
$temp=0;

if(isset($_POST["Giris"])){
    if(!empty($_POST["UserName"])&&!empty($_POST["Password"])){
        $UserName = $_POST["UserName"];
        $Password = $_POST["Password"];

        $ConnectingDB;
        $ask_login = $ConnectingDB->prepare('SELECT * FROM login WHERE username = ? && password = ? && status = 1');
        $ask_login->execute([$UserName, $Password]);

        $ask_login_2 = $ConnectingDB->prepare('SELECT * FROM login WHERE username = ? && password = ? && status = 0');
        $ask_login_2->execute([$UserName, $Password]);

        $rslt = $ask_login->rowCount();
        $rslt2 = $ask_login_2->rowCount();
        if($rslt==1){
            
            session_regenerate_id(true);
            $_SESSION["LogedIn"]=true;
            $_SESSION["username"]=$UserName;
            go("indexx.php");
        }
        else if($rslt2==2){
            $temp=1;
            comeback(2);
        }
        else{
            $temp=2;
            comeBack(2);
        }

    }
    else{
        $temp=3;
        comeBack(5);
    }

}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8" />
        <title>Login Page</title>

        <!--  icons   -->
        <script src="https://kit.fontawesome.com/a83a57c5c9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css" href="css/font-awesome.css"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" />
    </head>
    <!-- BODY -->
    <body class="container bg-back">
        <!-- Header  of body-->
        <header>
            <nav id="navbar">
                <div class="navbar-brand text-white text-center">
                    YLRSecurity Employee Managment System
                </div>
            </nav>
        </header>
        <!-- Header  -->
        <div id="giris">
            <form  id="girisformu" action="" method="post">
                <h2>Login</h2>
                <input type="text" name="UserName" value="" placeholder="Username" autocomplete="false">
                <input type="password" name="Password" value="" placeholder="Password" autocomplete="false">
                <?php 
                if($temp==1){
                    echo "Your account not activated";
                }
                else if($temp==2){ 
                    echo "Wrong username or password";
                } 
                else if($temp==3){ 
                    echo "Username and password musn't be empty";
                } ?>
                <input type="submit" name="Giris" value="Login" >
                <ul><a>Not registered yet? </a><a href="Sign_up.php">Create an Account</a></ul>
            </form> 
            
        </div>
    
    </body>
    <!-- BODY -->
</html>
