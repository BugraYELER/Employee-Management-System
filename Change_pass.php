<?php 
require_once("Require.php");
$error=0;
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}

if(isset($_POST["Change_pass"])){
    if(!empty($_POST["Password"])&&!empty($_POST["NewPassword"])&&!empty($_POST["NewPassword_again"])){

        $UserName = $_SESSION["username"];
        $sql1 = "SELECT password FROM login WHERE username='$UserName'";
        $stmt = $ConnectingDB->query($sql1);
        $DataRows=$stmt->fetch();
        $DbPass = $DataRows["password"];
        $Password = $_POST["Password"];
        $NewPassword = $_POST["NewPassword"];
        
        if($_POST["NewPassword"]==$_POST["NewPassword_again"]){

            if($DbPass==$Password){
                $ConnectingDB;
                $sql = "UPDATE login SET password='$NewPassword' WHERE username = '$UserName' && password = '$Password'";
                $Execute = $ConnectingDB->query($sql);
                if($Execute){
                    go("Login.php");
                }
            }
            else{
                $error=1;
                comeBack(2);
            }     
        }
        else{
            $error=2;
            comeBack(2);
        }     
    }
    else{
        $error=3;
        comeBack(2);
    }   
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Change Password Page</title>

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
        <div id="change_pass">
            <form  id="girisformu" action="" method="post">
                <h2>Change Password</h2>
                <?php
                if($error==1){    
                   echo "Wrong Current Password";
                }
                else if($error==2){
                    echo "New passwords not match";
                }
                else if($error==3){ 
                    echo "These sides musn't be empty";
                } 
                ?>
                <input type="password" name="Password" value="" placeholder="Current Password" autocomplete="false">
                <input type="password" name="NewPassword" value="" placeholder="New Password" autocomplete="false">
                <input type="password" name="NewPassword_again" value="" placeholder="New Password Again" autocomplete="false">
                <input type="submit" name="Change_pass" value="Change" ><br>
                <ul><a>Return </a><a href="View_emp.php">Employee Managment System</a></ul>
            </form> 
            
        </div>
    
    </body>
    <!-- BODY -->
</html>