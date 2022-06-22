<?php 

require_once("Require.php");
$temp=0;

if(isset($_POST["Sign_up"])){
    if(!empty($_POST["UserName"])&&!empty($_POST["Password"])&&!empty($_POST["Password_again"])&&($_POST["Password"]==$_POST["Password_again"])){
        $UserName = $_POST["UserName"];
        $Password = $_POST["Password"];

        $sql = "INSERT INTO login(username, password) VALUES(:usernamE,:passworD)";

        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('usernamE',$UserName); 
        $stmt->bindValue('passworD',$Password);

        $Execute = $stmt->execute();

        if($Execute){
            $temp=1;
            go("Login.php");
        }

    }
    else if(!(!empty($_POST["UserName"])&&!empty($_POST["Password"])&&!empty($_POST["Password_again"]))){
        $temp=2;
        comeBack(1);
    }

    else if($_POST["Password"]!=$_POST["Password_again"]){
        $temp=3;
        comeBack(1);
    }


}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Sign Up Page</title>

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
        <div id="kayit">
            <form  id="girisformu" action="" method="post">
                <h2>Sign Up</h2>
                <input type="text" name="UserName" value="" placeholder="Username" autocomplete="false">
                <input type="password" name="Password" value="" placeholder="Password" autocomplete="false">
                <input type="password" name="Password_again" value="" placeholder="Password Again" autocomplete="false">
                <?php 
                if($temp==1){ 
                    echo "Kullanıcı baraşıyla kaydedildi";
                }        
                if($temp==2){ 
                    echo "Kullanıcı adı ve şifreleri boş bırakmayınız";
                } 
                if($temp==3){ 
                    echo "Şifreler eşleşmemektedir.";
                } 
                
                ?>
                <input type="submit" name="Sign_up" value="Sign Up" ><br>

                <ul><a>Already a user? </a><a href="Login.php">LOGIN</a></ul>
            </form> 
            
        </div>
    
    </body>
    <!-- BODY -->
</html>
