<?php
include('config/db_connect.php');

//query to get all ice cream
$sql = 'SELECT * FROM icecream';

//make query and get results
$result = mysqli_query($conn, $sql);

//fetch result as array
$icecreams = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);



?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Ice Cream!!</h4>
<div class="container">
<div class="row">
    <?php foreach($icecreams as $icecream){?>
        <div class="col s6 md3">
            <div class="card z-depth-0">
                <img src="img/icecream.avif" class="icecream" alt="">
                <div class="card-content center">
                    <h6><?php echo htmlspecialchars($icecream['title']) ?></h6>
                    <ul><?php foreach(explode(',', $icecream['ingredients']) as $ing) {?>
                        <li><?php echo htmlspecialchars($ing) ?></li>

                    <?php  } ?>
                    </ul>

                </div>
                <div class="card-action right-align">
                    <a href="details.php?id=<?php echo $icecream['id'] ?>" class="brand-text">More Info</a>
                </div>
            </div>
        </div>

        <?php } ?>

</div>
</div>
<?php include('templates/footer.php'); ?>

</body>

</html>