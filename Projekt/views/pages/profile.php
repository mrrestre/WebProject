<?php
$userData = fetchUsers( $database );

foreach($userData as $row)
{
    if($row['userId'] === $_SESSION['currentUser'])
    {
        $name = $row['userName'];
        $birthdate = $row['DOB'];
        $country = $row['country'];
        $phone = $row['phone'];
        $eMail = $row['eMail']; 
    }
}

?>


<strong> Name: </strong> <?=$name; ?> <br><br>
<strong> Birthdate: </strong> <?=$birthdate; ?> <br><br>
<strong> Country: </strong> <?=$country; ?> <br><br>
<strong> Phone Number: </strong> <?=$phone; ?> <br><br>
<strong> E-Mail: </strong> <?=$eMail; ?> <br><br>
<a href="index.php?page=updateProfile"> Update Password </a> <br>