<?php 
require_once("Require.php");
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}
$SearchQueryParameter = $_GET["id"];
$count=0;
if(isset($_POST["Delete"])){

    $sql = "DELETE FROM emp WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    $count=1;
    if($Execute){
        echo '<script>window.open("View_emp.php","_self")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Employee Profile</title>
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
        <div>
        <?php 
        $ConnectingDB;
        $sql = "SELECT * FROM emp WHERE id='$SearchQueryParameter'";
        $stmt = $ConnectingDB->query($sql);

        while($DataRows=$stmt->fetch()){

            $ID = $DataRows["id"];
            $EmpName = $DataRows["empname"];
            $EmpSurname = $DataRows["empsurname"];
            $SSN = $DataRows["ssn"];
            $Department = $DataRows["department"];
            $Salary = $DataRows["salary"];
            $HomeAddress = $DataRows["homeaddress"];
            $Sex = $DataRows["sex"];
            $Handicapped = $DataRows["handicapped"];
            $Email = $DataRows["email"];
        }
        if(file_exists("uploads/$ID.png")){
            ?>
            <div id="FieldPhoto">
                <aside align="right">
                    <?php
                        echo '<img src="uploads/'.$ID.'.png" width="150" height="150">'
                    ?>
                    <br>
                    <ul>
                        <form action="upload.php?id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data"></form>       
                    </ul>
                </aside>             
            </div>
    
            <?php
            }
            else{
            ?>
            <div id="FieldPhoto">
                <aside align="right">
                    <img src="assets/images/ylrsec.png" width="150" height="150"><br>
                    <ul>
                        <form action="upload.php?id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data"></form>       
                    </ul>
                </aside>             
            </div>
            <?php
            }
        
        
        ?>
        

        <form id=emp-add action="Delete_emp.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
            <fieldset class="emp-add"> 
            <br>
                <span class="FieldInfo">Name: </span>
                <span class="FieldInfo"><?php echo $EmpName; ?></span><br>
                <br><br>
                <span class="FieldInfo">Surname:</span>
                <span class="FieldInfo"><?php echo $EmpSurname; ?></span><br>
                <br><br>

                <span class="FieldInfo">Sex: </span>
                <span class="FieldInfo"><?php echo $Sex; ?></span><br>
                <br><br>

            
                <span class="FieldInfo">Handicapped:</span>
                <span class="FieldInfo"><?php echo $Handicapped; ?></span><br>
                <br><br>
                
                    
                <span class="FieldInfo">SSN:</span>
                <span class="FieldInfo"><?php echo $SSN; ?></span><br>
                <br><br>

                <span class="FieldInfo2">Email:</span>
                <span class="FieldInfo"><?php echo $Email; ?></span><br>
                <br><br>

                <span class="FieldInfo">Department:</span>
                <span class="FieldInfo"><?php echo $Department; ?></span><br>
                <br><br>

                <span class="FieldInfo2">Salary:</span>
                <span class="FieldInfo"><?php echo $Salary; ?></span><br>
                <br><br>

                <span class="FieldInfo2">Home Address:</span>
                <span class="FieldInfo"><?php echo $HomeAddress; ?></span><br>
                <br>  

                <input type="submit" name="Delete" value="Delete"><br>
            </fieldset>
        </form>

<?php   if($count==1){ ?>
            <div class="overlay" id="divOne">
                <div class="wrapper">
                    <h2>Çalışan bilgileri başarıyla güncellendi...</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <div class="container">
                            <form>
                                <input type="submit" value="TAMAM">
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
<?php   } ?>
    </div>
        </main>

</body>
        

</html>
