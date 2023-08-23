<?php
include('config/db_connect.php');

//to delete
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM icecream WHERE id='$id_to_delete'";
    if(mysqli_query($conn, $sql)){
        header('location: index.php');
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Make SQL query to select an item
    $sql = "SELECT * FROM icecream WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    // Check for errors in the query execution
    if(!$result) {
        echo 'Query error: ' . mysqli_error($conn);
    } else {
        $icecream = mysqli_fetch_assoc($result);

        // Free result from memory
        mysqli_free_result($result);

        // Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<div class="container center grey-text">
    <?php if($icecream) { ?>
        <h4><?php echo htmlspecialchars($icecream['title']) ?></h4>
        <p>Created by: <?php echo htmlspecialchars($icecream['email']); ?></p>
        <p><?php echo date($icecream['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($icecream['ingredients']); ?></p>
        
        <!-- Form to delete the ice cream item -->

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $icecream['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    <?php } else { ?>
        <p>No ice cream found.</p>
    <?php } ?>
</div>

<?php include('templates/footer.php'); ?>
</html>
