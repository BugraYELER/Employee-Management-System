<?php 
require_once("Require.php");
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Employee from Database</title>
    <script src="https://kit.fontawesome.com/a83a57c5c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" href="css/font-awesome.css"/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" />
</head>

<body class="container bg-back">
        <!-- Header  of body-->
        <header>
            <nav id="navbar">
                <div id="leftSidebar" onclick="toggleLeftSidebar()">
                    <ul>
                        <li><a href="View_emp.php">View Employee</a></li>
                        <li><a href="Insert_emp.php">Add Employee</a></li>
                        <li><a href="Update_emps.php">Update Employee</a></li>
                        <li><a href="Delete_emps.php">Delete Employee</a></li>
                    </ul>  
                    <div class="left-side-button"></div>
                </div>      
                <script src="js/main.js"></script>
                <div class="navbar-brand text-white text-center">
                    YLRSecurity Employee Managment System
                </div>
                
                <div id="rightSidebar" onclick="toggleRightSidebar()">  
                    <ul>
                        <li><a href="Change_pass.php">Change Password</a></li>
                        <li><a href="Exit.php">Logout</a></li>
                        
                    </ul>               
                    <div class="right-side-button"></div>
                </div>
            </nav>
        </header>
        <!-- Header  -->

        <main id="sitemain">
            <div id=main>
                <h2>
                    <?php echo " ".$_SESSION["username"].", Welcome to YLRSecurity Employee Managment System " ?>
                </h2>
            </div>
        </table>
    </main>
</body>
     
</html>
