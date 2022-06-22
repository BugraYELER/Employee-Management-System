<?php 
require_once("Require.php");
if(!(isset($_SESSION["LogedIn"]) && $_SESSION["LogedIn"] == true)){
    go("Exit.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee from Database</title>
    <script src="https://kit.fontawesome.com/a83a57c5c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" href="css/font-awesome.css" s/> 
    <link rel="stylesheet" href="css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" />
</head>

<body class="container-sm">
        <!-- Header  of body-->
        <header class="container-sm">
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
                <form class="search-box" action="View_emp.php" method="post">        
                    <button class="search-btn" name="submit"><div class="search-button"></div></button>
                    <input class="search-txt" type="text" name="search" placeholder="Search">
                </form>  
                
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

        <table class="table table-primary" width="1000" border="2" align="center">
            <caption class="text-baslik">Employee <br></br></caption>
            <tr>
                <th>NUMBER</th>
                <th>ID</th>  
                <th>NAME</th>
                <th>SURNAME</th>
                <th>SSN</th>
                <th>Email</th>
                <th>DEPARTMENT</th>
                <th>SALARY</th>
                <th>HOME ADDRESS</th>
                <th>PROFILE</th>
                <th>UPDATE</th>
                <th>DELETE</th>
                
            </tr>
            <?php 
            global $ConnectingDB;
            if (isset($_POST["submit"])) {
                $str = $_POST["search"];
                $sql = "SELECT * FROM `emp` WHERE empname LIKE '%$str%' OR empsurname LIKE '%$str%' OR ssn LIKE '%$str%' OR department LIKE '%$str%' OR email LIKE '%$str%'";


            }
            else{
                $sql = "SELECT * FROM emp";
            }
            
            $stmt = $ConnectingDB->query($sql);
            $i=0;
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
                $i+=1;
            ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $ID; ?></td>
                <td><?php echo $EmpName; ?></td>
                <td><?php echo $EmpSurname; ?></td>
                <td><?php echo $SSN; ?></td>
                <td><?php echo $Email; ?></td>
                <td><?php echo $Department; ?></td>
                <td><?php echo $Salary; ?></td>
                <td><?php echo $HomeAddress; ?></td>
                <td style="text-align: center"><a href="Profile_emp.php?id=<?php echo $ID; ?>">Profile</a></td>
                <td style="text-align: center"><a href="Update_emp.php?id=<?php echo $ID; ?>">Update</a></td>
                <td style="text-align: center"><a href="Delete_emp.php?id=<?php echo $ID; ?>">Delete</a></td>
                
            </tr>
            <?php 
            } 
            ?>



        </table>
    </main>
</body>
     
</html>
