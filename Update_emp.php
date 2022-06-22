<?php 
require_once("Require.php");
require_once("upload.php");
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}
$SearchQueryParameter = $_GET["id"];
$count=0;
if(isset($_POST["Update"])){

    if(!empty($_POST["EmpName"])&&!empty($_POST["EmpSurname"])&&!empty($_POST["SSN"])&&!empty($_POST["Department"])){
        $EmpName = $_POST["EmpName"];
        $EmpSurname = $_POST["EmpSurname"];
        $SSN = $_POST["SSN"];
        $Department = $_POST["Department"];
        $Salary = $_POST["Salary"];
        $HomeAddress = $_POST["HomeAddress"];
        $Sex = $_POST["Sex"];
        $Handicapped = $_POST["Handicapped"];
        $Email = $_POST["Email"];
        $ConnectingDB;
        $sql = "UPDATE emp SET empname='$EmpName', empsurname='$EmpSurname', ssn='$SSN', department='$Department', salary='$Salary', homeaddress='$HomeAddress', sex='$Sex', handicapped='$Handicapped', email='$Email' WHERE id='$SearchQueryParameter'";
        $Execute = $ConnectingDB->query($sql);
        if($Execute){
            go("View_emp.php");
            $count=1;
        }
    }

    else{

        echo '<span class="text-uyarı">Düzenleme Tamamlanamadı, Yıldızlı alanlar boş bırakılamaz!!!</span>';

    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Employee</title>
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
                    <form action="upload.php?id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload" style="color:transparent; width:80px;">
                        <input type="submit" value="Upload" name="submittx">
                    </form>       
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
                    <form action="upload.php?id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload" style="color:transparent; width:80px;">
                        <input type="submit" value="Upload" name="submittx">
                    </form>       
                </ul>
            </aside>             
        </div>
        <?php
        }
        ?>
        
        <form id=emp-add action="Update_emp.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
            <fieldset class="emp-add"> 
                <span class="FieldInfo">Name:</span><br>
                <input type="text" name="EmpName" value="<?php echo $EmpName; ?>"><br>
                <br>
                <span class="FieldInfo">Surname:</span><br>
                <input type="text" name="EmpSurname" value="<?php echo $EmpSurname; ?>"><br>
                <br>

                <label for="Sex" allign="right">Sex:</label><br>
                <select name="Sex">
                    <?php
                    if($Sex=="male"){
                    ?>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    <?php    
                    }
                    else{
                    ?>   
                        <option value="female">Female</option>
                        <option value="male">Male</option>   
                    <?php
                    }
                    ?>
                </select><br><br>

                <?php
                if($Handicapped=="yes"){
                ?>
                <p>Handicapped:</p>
                <input type="radio" name="Handicapped" value="yes" checked>
                <label for="yes">Yes</label>
                <input type="radio" name="Handicapped" value="no">
                <label for="no">No</label><br><br>
                <?php    
                }
                else{
                ?>   
                <p>Handicapped:</p>
                <input type="radio" name="Handicapped" value="yes">
                <label for="yes">Yes</label>
                <input type="radio" name="Handicapped" value="no" checked>
                <label for="no">No</label><br><br>
                <?php    
                }
                ?>

                <span class="FieldInfo">SSN:</span><br>
                <input type="text" name="SSN" value="<?php echo $SSN; ?>"><br>
                <br>

                <span class="FieldInfo2">Email:</span><br>
                <input type="text" name="Email" value="<?php echo $Email; ?>"><br>
                <br>

                <span class="FieldInfo">Department:</span><br>
                <input type="text" name="Department" value="<?php echo $Department; ?>"><br>
                <br>
                <span class="FieldInfo2">Salary:</span><br>
                <input type="text" name="Salary" value="<?php echo $Salary; ?>"><br>
                <br>
                <span class="FieldInfo2">Home Address:</span><br>
                <textarea name="HomeAddress" rows="7" cols="60"><?php echo $HomeAddress; ?></textarea><br>
                <br>  
                <input type="submit" name="Update" value="Update"><br>

                <style>
                    .FieldInfo:after { content:" *"; }
                </style>
            </fieldset>
        </form>
    </div>   
</main>

</body>
     
</body>
</html>
