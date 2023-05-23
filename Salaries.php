<?php

require "config.php";

use App\Employee;

$emps = Employee::historylist($_GET['emp']);

$dept = Employee::getByDeptId($_GET['dept']);
$emply = Employee::getByEmpId($_GET['emp']);
$titles = Employee::getByTitleId($_GET['emp']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Salary History</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container-fluid mt-3">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a><br><br>
        <h2>Salary History of <?php echo $employee ->getEmpName();?></h2>
        <h4><strong>Department:</strong> <?php echo $department->getDeptName();?> | <strong>Title:</strong> <?php echo $titles ->getTitle();?> | <strong>Birthdate:</strong> <?php echo $employee ->getBirthdate();?> | <strong>Gender:</strong>
            <?php 
                if($employee ->getGender() == "M"){
                    echo "Male";
                }else{
                    echo "Female";
                }
            ?>
        </h4>
        <table id="salaryTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach ($sals as $row){
                    echo "<tr>";

                    $cols = get_object_vars($row);
                    echo "<td>".$cols["From_Date"]."</td>";
                    echo "<td>".$cols["To_Date"]."</td>";
                    echo "<td>".$cols["Salary"]."</td>";

                    echo "<td><a href = 'Department.php?dept=".$cols["From_Date"]."&emp=".$cols["Department_Number"]."
                            '>View</a></td>";
                }
            ?>
            </tbody>
            </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#salaryTable').DataTable();
        } );
    </script>
    </body>
</html>
