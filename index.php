<?php

require "config.php";

use App\Department;
use App\Employee;
use App\Salary;

$depts = Department::list();
$emps = Employee::list();
$sals = Salary::list();
?>


<?php 
    foreach ($depts as $row){
        echo "<tr>";

        $cols = get_object_vars($row);
        echo "<td>".$cols["Department_Number"]."</td>";
        echo "<td>".$cols["Department_Name"]."</td>";
        echo "<td>".$cols["FullName"]."</td>";
        echo "<td>".$cols["From_Date"]."</td>";
        echo "<td>".$cols["To_Date"]."</td>";
        echo "<td>".$cols["Number_of_Years"]."</td>";

        echo "<td><a href = 'Employee.php?dept=".$cols["Department_Number"]."&emp=".$cols["Manager_Number"]."
                  '>View</a></td>";
    }
?>

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




