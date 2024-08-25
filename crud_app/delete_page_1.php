<?php include('dbcon.php')
?>


<?php


    if(isset($_GET['Id'])){
        $id = $_GET['Id'];
    }
$query = "DELETE FROM `students` WHERE `id`= '$id'";

$result = mysqli_query($connection, $query);

if(!$result){
    die("Query failed".mysqli_error());
}

else{
    header('location:index.php?delete_msg=You have successfully deleted');
}
?>