<?
if(isset($_POST['submit']))
{
    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];
        deleteUserFromDatabase($database, $email);
    }
}



?>

<form action="index.php?page=deleteUser" method="POST">

<label for="email">User's E-Mail*</label><br>
    <input type="email" id="email" name="email" placeholder="User's E-Mail" required><br>

<!-- TODO in Java Script: bestätigung des Prozesses -->
<label for="submit">
    <input type="submit" id="submit" name="submit" value="Delete">
</label>

</form>