<?php 
require_once('db/db_connection.php');
if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `work_schedule_table` where id = '{$_GET['id']}'");
if($delete){
    // echo "<script> alert('La cita ha sido eliminado correctamente.'); location.replace('./') </script>";
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