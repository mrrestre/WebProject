<?php
$status='';
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['firstName'])
        &&!empty($_POST['surname'])
        &&!empty($_POST['password'])
        &&!empty($_POST['passwordagain'])
        &&!empty($_POST['gender'])
        &&!empty($_POST['DOB'])
        &&!empty($_POST['country'])
        &&!empty($_POST['phone'])
        &&!empty($_POST['eMail']))
        {
            $fname=         $_POST['firstName'];
            $lname=         $_POST['surname'];
            $password=      $_POST['password'];
            $passwordagain= $_POST['passwordagain'];
            $gender=        $_POST['gender'];
            $birthdate=     $_POST['DOB'];
            $country=       $_POST['country'];
            $phone=         $_POST['phone'];
            $email=         $_POST['eMail'];
            if($password === $passwordagain)
            {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $request = $database->prepare("INSERT INTO user (firstName, surname, password, gender, DOB, country, phone, eMail)
                                                VALUES (:firstName, :surname, :password, :gender, :DOB, :country, :phone, :eMail)");
                
                $request->execute(['firstName' => $fname,
                                'surname' => $lname,
                                'password' => $passwordHash,
                                'gender' => $gender,
                                'DOB' => $birthdate,
                                'country' => $country,
                                'phone' =>   $phone ,
                                'eMail' => $email]);
                echo 'you were successfully registred';
                header('Location: index.php?page=login');            
            }
            else{
                $status = 'Password and Passwordagain must be the same!!';
                echo $status;
            }
        }
        else
        {
            $status= 'All fields must be filled';
            echo $status;
        }
    }
    else{
    }



?>

<html>
<head>
    <!-- hier den css von registrierung hinzüfugen -->
</head>
<body>
    <div class="content-wrap">
        <h1>Welcome to the Registration</h1>

        <div class="loginclass">
            <form action="index.php?page=registration" method="POST">
                            
                <label for="firstName">First Name*</label><br>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required><br>
                
                <label for="surname">Last Name*</label><br>
                <input type="text" id="surname" name="surname" placeholder="Last Name" required><br>
                    
                <label for="password">Password*</label><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br>
                    
                <label for="passwordagain">Password*</label><br>
                <input type="password" id="passwordagain" name="passwordagain" placeholder="Password" required><br>
                    
                <label for="gender">Gender*</label><br>  
                <input type="radio" value="m" id="male" name="gender" required>   
                <label for="male">male</label>
                <input type="radio" value="f" id="female" name="gender" required>
                <label for="female">female</label><br>
                                
                <label for="DOB">Date of Birth*</label><br>
                <input type="date" id="DOB" name="DOB" required><br>
                    
                <label for="country">Country*</label><br>
                <?php include ROOT.'/assets/country/country.html'; ?> <br>

                <label for="phone">Telephone Number*</label><br>
                <input type="number" id="phone" name="phone" placeholder="Telephone Number" required><br>

                <label for="eMail">E-Mail*</label><br>
                <input type="email" id="eMail" name="eMail" placeholder="E-Mail" required><br>

                <label for="submit">
                <input type="submit" id="submit" name="submit" value="Send">
                </label>
                
                <label for="reset">
                <input type="reset" id="reset" name="reset" value="Reset">
                </label>
            </form>
        </div>
    </div>

    <? echo $status?>

</body>
</html>