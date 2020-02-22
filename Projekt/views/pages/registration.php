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
        
        
        <div class="sectionAll">
            <div class="leftSection">
            <h1 class="salutation">Registration</h1>
            
            <form action="index.php?page=registration" method="POST" onsubmit="validRegistrationForm()">
            <div id="error"></div>
            <table width="100%" >
                <tr>             
                <td><label for="firstName">First Name*</label></td>
                <td><input type="text" id="firstName" name="firstName" placeholder="First Name" required></td>
                </tr>
                <tr>
                <td><label for="surname">Last Name*</label></td>
                <td><input type="text" id="surname" name="surname" placeholder="Last Name" required></td>
                </tr>
                <tr>
                <td><label for="password">Password*</label></td>
                <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>   
                <td><label for="passwordagain">Password*</label></td>
                <td><input type="password" id="passwordagain" name="passwordagain" placeholder="Password" required></td>
                </tr>
                <tr>   
                <td><label for="gender">Gender*</label></td>  
                <td><input type="radio" value="m" id="male" name="gender" required>   
                <label for="male">male</label>
                <input type="radio" value="f" id="female" name="gender" required>
                <label for="female">female</label></td>
                </tr>
                <tr>               
                <td><label for="DOB">Date of Birth*</label></td>
                <td><input type="date" id="DOB" name="DOB" required></td>
                </tr>  
                <tr> 
                <td><label for="country">Country*</label></td>
                <td><?php include ROOT.'/assets/country/country.html'; ?> </td>
                </tr>
                <tr>
                <td><label for="phone">Telephone Number*</label></td>
                <td><input type="number" id="phone" name="phone" placeholder="Telephone Number" required></td>
                </tr>
                <tr>
                <td><label for="eMail">E-Mail*</label></td>
                <td><input type="email" id="eMail" name="eMail" placeholder="E-Mail" required></td>
                </tr>
            </table>
                <br>
                <br>
                <label for="reset">
                <input type="reset" class="resetButton" id="reset" name="reset" value="Reset">
                </label>
                <label for="submit">
                <input type="submit" class="registrationButton" id="submit" name="submit" value="Send">
                </label>
                
            </form>
            </div> <!-- leftSection-->
            <div class="rightSection">
               <p>
                   create now your User Account <br> and stay up to date on everything <br> about Laptops, Tablets and Smartphones...
               </p>
            </div>
            </div>   <!-- sectionAll -->
        
    </div> <!--content_wrap-->

    <? echo $status?>

</body>
</html>