<?php
require "config.php";

use App\Department;
use App\Salary;

$depts = Department::list();
$sals = Salary::list();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
body{
    background:
    linear-gradient(red, transparent),
    linear-gradient(to top left, lime, transparent),
    linear-gradient(to top right, blue, transparent);
    background-blend-mode: screen;
}

table{
    font-size: 20px;
    text-align: center;
    vertical-align: middle;
    border-spacing: 30px;
}

th{
    font-size: 40px;
}

tbody{
    font-size: 30px;
    font-style: bold;
    font-family: Arial;
}
</style>
<body>
    <div class="container-fluid mt-3">
        <h2>Departments</h2>
        <table id="departmentTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Department Number</th>
                    <th>Department Name</th>
                    <th>Manager Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Number of Years</th>
                    <th>Employees</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                        foreach ($depts as $row){
                            echo "<tr>";

                            $cols = get_object_vars($row);
                            echo "<td>".$cols["Department_Number"]."</td>";
                            echo "<td>".$cols["Department_Name"]."</td>";
                            echo "<td>".$cols["Manager_Name"]."</td>";
                            echo "<td>".$cols["From_Date"]."</td>";
                            echo "<td>".$cols["To_Date"]."</td>";
                            echo "<td>".$cols["Number_of_Years"]."</td>";

                            echo "<td><a href = 'Employee.php?dept=".$cols["Department_Number"]."&emp=".$cols["Manager_Number"]."
                                    '>View</a></td>";
                        }
                    ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#departmentTable').DataTable();
        } );
    </script>
</body>
</html>






