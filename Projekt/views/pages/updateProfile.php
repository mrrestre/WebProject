<?php
if(isset($_POST['submit']))
{
    if( !empty($_POST['newPassword'])
        &&!empty($_POST['repeatPassword']))
        {
            $password = $_POST['newPassword'];
            $repeatPassword = $_POST['repeatPassword'];
            $userId = $_SESSION['currentUser'];
            if($password === $repeatPassword)
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $request = $database->prepare("UPDATE user SET password = ? WHERE userId =? ");
                
                $request->execute([$hash, $userId]);

                echo 'The Update was Successful';
            }
            else{
                echo 'The password is not the same !!! ';
            }
        }
}
?>




<h3>Update Your Data </h3>
<hr>

<form action="index.php?page=updateProfile" method="POST">


    <label for="newPassword">New Password</label><br>
    <input type="password" id="newPassword" name="newPassword" placeholder="New Password"><br>

    <label for="repeatPassword">repeat the New Password</label><br>
    <input type="password" id="repeatPassword" name="repeatPassword" placeholder="repeat the New Password"><br><br>

    <label for="submit">
        <input type="submit" name="submit" id="submit" value="Save Changes">
    </label>

</form>