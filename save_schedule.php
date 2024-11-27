<?php 
require_once('db/db_connection.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($id)){
    $sql = "INSERT INTO `work_schedule_table` (`title`,`employee`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title', '$employee', '$description','$start_datetime','$end_datetime')";
}else{
    $sql = "UPDATE `work_schedule_table` set `title` = '{$title}', `employee` = '{$employee}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}
$save = $conn->query($sql);
if($save){
    // echo "<script> alert('Cita registrada!.'); location.replace('./') </script>";
    header("Location: admin.php");
    
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>