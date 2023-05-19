<?php

namespace App;

use Exception;

class Salary
{
    public static function list()
    {
        global $conn;

        try {
            $sql = "SELECT 
            s.from_date AS From_Date, 
            s.to_date AS To_Date, 
            s.salary AS Salary
        FROM salaries AS s
        ORDER BY s.salary DESC
        LIMIT 20";

            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = [];

            while ($row = $statement->fetchObject('App\Salary')) {
                array_push($records, $row);
            }

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}