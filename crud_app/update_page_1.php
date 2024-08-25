<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<?php
if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
} else {
    die("No ID specified.");
}

// Escape the ID to prevent SQL injection
$id = mysqli_real_escape_string($connection, $id);

// Correct the query by using backticks or no quotes
$query = "SELECT * FROM `students` WHERE `Id` = '$id'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
} else {
    // Fetch the result as an associative array and print it
    $row = mysqli_fetch_assoc($result);
}
?>

<?php
if (isset($_POST['update_students'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $connection->prepare("UPDATE `students` SET `first_name` = ?, `last_name` = ?, `age` = ? WHERE `Id` = ?");
    $stmt->bind_param("ssii", $fname, $lname, $age, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header('location:index.php?update_msg=You have successfully updated');
    } else {
        die("Query execution failed: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}
?>

<form action="update_page_1.php?Id=<?php echo $id;?>" method="post">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo htmlspecialchars($row['first_name']); ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo htmlspecialchars($row['last_name']); ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age']); ?>">
    </div>
    <input type="submit" class="btn btn-success" name="update_students" value="Update">
</form>

<?php include('footer.php'); ?>
