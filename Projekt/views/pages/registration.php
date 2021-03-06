<?php
$status='';
    if(isset($_POST['submit']) || isset($_POST['ajax']))
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

            // Is this Mail not already registered?
            $availableEmail = isEmailAvailable($database, $email);

            // Does this password work for our safety standards?
            $isPasswordSafe = isPasswordSafe($password);

            if($availableEmail == true)
            {
                if($password === $passwordagain)
                {
                    if($isPasswordSafe == true)
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
                        $status = 'Password not safe enough';
                    }
                }
                else{
                    $status= 'Password and Repeat Password must be the same!!';
                }
                
            }
            else {
                $status= 'Email already beeing used';
            }
        }
        else
        {
            $status= 'All fields must be filled';
        }

        if(isset($_POST['ajax']))
        {
            echo 'the date were successfully received ';
        }
        else{
           echo 'something went wrong, please try later';
        }
    }
    else{
    }



?>

<html>
    <body>
        <div class="content-wrap">
            <div class="sectionAll">
                <div class="leftSection">
                    <?php 
                        if(isset($status))
                        {
                            echo "<div class=\"status\">$status</div>"; 
                        }
                    ?>
                    <h1 class="salutation">Registration</h1>
                    
                    <form name="registForm" id="registForm" action="index.php?page=registration" method="POST" onsubmit="return registrationFormValidation()">
                    <div id="error"></div>
                    <table width="100%" >
                        
                        <tr>             
                            <td><label for="firstName">First Name*</label></td>
                            <td><input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php if(isset($_POST['firstName'])) echo htmlspecialchars($_POST['firstName']);?>" required></td>
                        </tr>
                        
                        <tr>
                            <td><label for="surname">Last Name*</label></td>
                            <td><input type="text" id="surname" name="surname" placeholder="Last Name" value="<?php if(isset($_POST['surname'])) echo htmlspecialchars($_POST['surname']);?>" required></td>
                        </tr>
                            
                        <tr>
                            <td>
                                Password must contain
                            </td>
                            <td> 
                                <ul>                    
                                    <li>
                                        Upper Case  
                                    </li>
                                    <li>
                                        Lower Case
                                    </li>
                                    <li>
                                        Special character [!@#$%^&*()\-_=+{};:,<.>] 
                                    </li>
                                    <li>
                                    At least 8 characters long
                                    </li>
                                </ul> 
                            </td>
                        </tr>

                        <tr>
                            <td><label for="password">Password*</label></td>
                            <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                        </tr>
                        
                        <tr>
                            <td><label for="passwordagain">Repeat Password*</label></td>
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
                            <td><input type="date" id="DOB" name="DOB" value="<?php if(isset($_POST['DOB'])) echo $_POST['DOB'];?>" required></td>
                        </tr>

                        <tr> 
                            <td><label for="country">Country*</label></td>
                            <td><?php include ROOT.'/assets/country/country.html'; ?> </td>
                        </tr>

                        <tr>
                            <td><label for="phone">Telephone Number*</label></td>
                            <td><input type="number" id="phone" name="phone" placeholder="Telephone Number" value="<?php if(isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']);?>" required></td>
                        </tr>
                        
                        <tr>
                            <td><label for="eMail">E-Mail*</label></td>
                            <td><input type="email" id="eMail" name="eMail" placeholder="E-Mail" value="<?php if(isset($_POST['eMail'])) echo htmlspecialchars($_POST['eMail']);?>" required></td>
                        </tr>

                    </table>
                        
                    <br><br>
                        <div class="buttons">
                            <label for="reset">
                                <input type="reset" class="resetButton" id="reset" name="reset" value="Reset">
                            </label>
                            
                            <label for="submit">
                                <input type="submit" class="registrationButton" id="submit" name="submit" value="Send">
                            </label>
                        </div>                    
                    </form>
                </div> <!-- leftSection-->

                <div class="rightSection">
                <p>
                    Create now your User Account and stay up to date on everything about Laptops, Tablets and Smartphones
                </p>
                </div> <!-- rightSelection -->
            </div>   <!-- sectionAll -->           
        </div> <!--content_wrap-->
    </body>
</html>