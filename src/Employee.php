<?php

namespace App;

use Exception;

class Employee
{
    public static function list()
    {
        global $conn;

        try {
            $sql = "SELECT 
            d.dept_name, 
            t.title AS Employee_Title, 
            CONCAT(e.first_name, ' ', e.last_name) AS Employee_Complete_Name,
            e.birth_date AS Employee_Birthday, 
            TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS Employee_Age,
               e.gender AS Employee_Gender, e.hire_date AS Employee_Hire_Date, s.salary
        FROM departments AS d
        JOIN dept_manager dm ON d.dept_no = dm.dept_no
        JOIN employees e ON dm.emp_no = e.emp_no
        JOIN titles t ON e.emp_no = t.emp_no
        JOIN (
          SELECT emp_no, MAX(to_date) AS LatestToDate
          FROM salaries
          GROUP BY emp_no
        ) latest_salaries AS Employee_Latest_Salary ON e.emp_no = latest_salaries.emp_no
        JOIN salaries s ON e.emp_no = s.emp_no AND latest_salaries.LatestToDate = s.to_date
        WHERE dm.to_date = (
          SELECT MAX(to_date)
          FROM dept_manager
          WHERE dept_no = d.dept_no
        );
        ";

            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = [];

            while ($row = $statement->fetchObject('App\Employee')) {
                array_push($records, $row);
            }

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}