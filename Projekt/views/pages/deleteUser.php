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
      
        echo "the User: $firstName $surname was deleted";
    }
    else{
        echo ' All fields must be filled';
    }
}
?>

<http>
    <body>
        <main>
            <div class="containerDiv"></div>
                <div class="innere"></div>
                    <form action="index.php?page=deleteUser" method="POST">

                        <label for="firstName">User's First Name*</label><br>
                            <input type="text" id="firstName" name="firstName" placeholder="First Name" required><br>
                        <label for="surname">User's Surname*</label><br>
                            <input type="text" id="surname" name="surname" placeholder="Surname" required><br>
                        <label for="email">User's E-Mail*</label><br>
                            <input type="email" id="email" name="email" placeholder="E-Mail" required><br>
                        <label for="submit">
                            <input type="submit" class="deleteButton" id="submit" name="submit" value="Delete" onclick="validDeleteUserForm()">
                        </label>
                    </form>
                </div>
            </div>
        </main>        
    </body>
</http>
