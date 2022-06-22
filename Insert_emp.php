<?php 
require_once("Require.php");
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}
$error=isset($_GET['error'])?$_GET['error']:0;
if(isset($_POST["Submit"])){

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

        if (filter_var($Email, FILTER_VALIDATE_EMAIL)== false) {
            $error=3;
            go("Insert_emp.php?error=3");
            exit();
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://emailvalidation.abstractapi.com/v1/?api_key=923ad0cc8e8f4ef6925b6f7c5c02f2dc&email=valleyofcoding@gmail.com');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response, true);

        if($data['deliverability']=="UNDELIVERABLE"){
            exit("Undeliverable");

        }

        if($data["is_disposable_email"]["value"] == true){
            exit("Disposable");
        }
        

        $ConnectingDB;
        $sql = "INSERT INTO emp(empname, empsurname, ssn, department, salary, homeaddress, sex, email, handicapped) VALUES(:empnamE,:empsurnamE,:ssN,:departmenT,:salarY,:homeaddresS, :seX, :emaiL, :handicappeD)";

        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('empnamE',$EmpName); 
        $stmt->bindValue('empsurnamE',$EmpSurname); 
        $stmt->bindValue('ssN',$SSN); 
        $stmt->bindValue('departmenT',$Department);
        $stmt->bindValue('salarY', $Salary); 
        $stmt->bindValue('homeaddresS',$HomeAddress); 
        $stmt->bindValue('seX', $Sex);
        $stmt->bindValue('emaiL', $Email);
        $stmt->bindValue('handicappeD', $Handicapped);

        $Execute = $stmt->execute();
        if($Execute){
            $error=1;
        }
    }

    else{
        $error=2;
        go("Insert_emp.php?error=2");
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Insert Employee</title>
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
    <div id="sitemain">

    <form id=emp-add action="" method="post">
        <?php 
        
        if($error==1){ 
            echo '<span class="text-bildirim">Kayıt Başarıyla Tamamlandı</span>';
            go("View_emp.php");
        } 
        else if($error==2){ 
            echo '<span class="text-uyarı">Starred fields can not be blank</span>';
        } 
        ?>
            <fieldset class="emp-add"> 
                <span class="FieldInfo">Name:</span><br>
                <input type="text" name="EmpName" value=""><br>
                <br>
                <span class="FieldInfo">Surname:</span><br>
                <input type="text" name="EmpSurname" value=""><br>
                <br>

                <label for="Sex" allign="right">Sex:</label><br>
                <select name="Sex">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><br><br>

                <p>Handicapped:</p>
                <input type="radio" name="Handicapped" value="yes">
                <label for="yes">Yes</label>
                <input type="radio" name="Handicapped" value="no">
                <label for="no">No</label><br><br>

                <span class="FieldInfo">SSN:</span><br>
                <input type="text" name="SSN" value=""><br>
                <br>

                <span class="FieldInfo2">Email: <?php
                if($error==3){ 
                    echo '<span class="text-red">(Wrong E-mail Address Format)</span>';
                } 
                ?></span><br>
                <input type="text" name="Email" value=""><br>
                <br>
                
                <span class="FieldInfo">Department:</span><br>
                <input type="text" name="Department" value=""><br>
                <br>
                <span class="FieldInfo2">Salary:</span><br>
                <input type="text" name="Salary" value=""><br>
                <br>
                <span class="FieldInfo2">Home Address:</span><br>
                <textarea name="HomeAddress" rows="7" cols="60"></textarea><br>
                <br>
                <?php  
                ?>
                <input type="submit" name="Submit" value="Submit"><br>

                <style>
                    .FieldInfo:after { content:" *"; }
                </style>

            </fieldset>
        </form> 
    </div> 
</body>
</html>
