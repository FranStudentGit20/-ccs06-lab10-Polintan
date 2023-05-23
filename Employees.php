<?php
require "config.php";

use App\Employee;

$emps = Employee::list($_GET['dept']);

$dept = Employee::getByDeptId($_GET['dept']);
$mngr = Employee::getByEmpId($_GET['emp']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

<body>
    <div class="container-fluid mt-3">
            <a href="javascript:history.back()" class="btn btn-primary">Back</a><br><br>
            <div class="col-md-6">
                <h2><strong>Department:</strong> <?php echo $department->getDeptName();?></h2>
                <h4><strong>Manager:</strong> <?php echo $manager->getEmpName();?></h4>
            </div>
        <table id="employeeTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Complete Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Hire Date</th>
                    <th>Latest Salary</th>
                    <th>Salary History</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($emps as $row){
                        echo "<tr>";

                        $cols = get_object_vars($row);
                        echo "<td>".$cols["Employee_Title"]."</td>";
                        echo "<td>".$cols["Employee_Complete_Name"]."</td>";
                        echo "<td>".$cols["Employee_Birthday"]."</td>";
                        echo "<td>".$cols["Employee_Age"]."</td>";
                        echo "<td>".$cols["Employee_Gender"]."</td>";
                        echo "<td>".$cols["Employee_Hire_Date"]."</td>";
                        echo "<td>".$cols["Employee_Latest_Salary"]."</td>";

                        echo "<td><a href = 'Salary.php?dept=".$cols["Employee_number"]."&emp=".$cols["Salary"]."
                                '>View</a></td>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#employeeTable').DataTable();
        } );
    </script>
</body>
</html>