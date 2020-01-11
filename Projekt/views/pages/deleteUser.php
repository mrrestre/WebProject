<?php
if(isset($_POST['submit']))
{
    if(!empty($_POST['email'])
    &&!empty($_POST['firstName'])
    &&!empty($_POST['surname']))
    {
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        deleteUserFromDatabase($database, $email);
      
        echo "the User: $firstName $surname is deleted";
    }
    else{
        echo ' all fields must be filled';
    }
}



?>

<form action="index.php?page=deleteUser" method="POST">

    <label for="firstName">User's First Name*</label><br>
        <input type="text" id="firstName" name="firstName" placeholder="User's First Name" required><br>
    <label for="surname">User's Surname*</label><br>
        <input type="text" id="surname" name="surname" placeholder="User's Surname" required><br>
    <label for="email">User's E-Mail*</label><br>
        <input type="email" id="email" name="email" placeholder="User's E-Mail" required><br>
    

<!-- TODO in Java Script: bestätigung des Prozesses -->
<label for="submit">
    <input type="submit" id="submit" name="submit" value="Delete">
</label>

</form>