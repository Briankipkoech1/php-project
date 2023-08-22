<?php
//connect to db

$conn= mysqli_connect('localhost', 'brian', '12345', 'icecream_man' ); 
//check connection
if(!$conn){
    echo 'connection error:' . mysqli_connect_error();
}

?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php');?>
<?php include('templates/footer.php');?>
    
</body>
</html>