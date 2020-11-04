<?php
include '../resources/config.php';

if(isset($_POST["selected"])) 
{
    $batch = join("','", $_POST["selected"]);
    $query = "SELECT * FROM students WHERE batch IN ('".$batch."')";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
    }
    echo $output;
}
?>