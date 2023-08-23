<!DOCTYPE html>
<html lang="en">
<?php
include('config/db_connect.php');

$title=$email=$ingredients='';
$errors=array('email'=>'', 'title'=>'', 'ingredients'=>'');

if (isset($_POST['submit'])) {
    //check email
    if (empty($_POST['email'])) {
        $errors['email']= 'An email is required <br/>';
    } else {
       $email= $_POST['email'];
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']='email must be a valid email';
       }
    };
    //Check title
    if (empty($_POST['title'])) {
        $errors['title']='Title is required <br/>';
    } else {
       $title= $_POST['title'];
       if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        $errors['title']= 'title must be letters and spaces only';
       }
    };
    //check ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients']=  'At least one ingredient is required <br/>';
    } else {
        $ingredients=$_POST['ingredients'];
       if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['ingredients']= 'Ingredients must be a comma separated list';
       }
    };
    if(array_filter($errors)){

    }else{

        //mysqli_real_escape_string used to protect against sql injections
        $email=mysqli_real_escape_string($conn, $_POST['email']);
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients=mysqli_real_escape_string($conn, $_POST['ingredients']);
        //insert into db
        $sql="INSERT INTO icecream(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
        if(mysqli_query($conn, $sql)){
            //redirecting to index page
            header('location: index.php');

        }else{
            echo 'query error: '. mysqli_error($conn);
        };
        
        
    };
};


?>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add Ice Cream</h4>
    <form action="add.php" class="white" method="POST">
        <label for="">Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"> <?php echo $errors['email']; ?></div>
        <label for="">Ice Cream Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"> <?php echo $errors['title']; ?></div>
        <label for="">Ingredients (Comma Separated):</label>
        <input type="text" name="ingredients">
        <div class="red-text"> <?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0" value="<?php echo htmlspecialchars($ingredients) ?>">
        </div>
    </form>

</section>

<?php include('templates/footer.php'); ?>

</body>

</html>