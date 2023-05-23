<?php

namespace App;

use Exception;

class Department
{
    public static function list()
    {
        global $conn;

        try {
            $sql = "SELECT 
                          d.dept_no AS Department_Number, 
                        d.dept_name AS Department_Name, 
                        CONCAT(m.first_name, ' ' , m.last_name) AS Manager_Name,
                        dm.from_date AS From_Date, 
                        dm.to_date AS To_Date,
                            TIMESTAMPDIFF(YEAR, dm.from_date, dm.to_date) AS Number_of_Years
                    FROM departments AS d
                    JOIN (
                    SELECT dept_no, emp_no, from_date, to_date,
                            ROW_NUMBER() OVER (PARTITION BY dept_no ORDER BY to_date DESC) AS RowNumber
                    FROM dept_manager 
                    ) dm ON d.dept_no = dm.dept_no AND dm.RowNumber = 1
                    JOIN employees AS m ON dm.emp_no = m.emp_no;";

            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = [];

            while ($row = $statement->fetchObject('App\Department')) {
                array_push($records, $row);
            }

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}