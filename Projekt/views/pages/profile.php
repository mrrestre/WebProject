<?php
$userData = fetchUsers( $database );
$gender;
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
// if ($userData['gender'] == 'm'){
//     $gender= 'man.png';
// }
// else{
//     $gender = 'woman.png';
// }


?>
<div class="all">
<div class="left">
        <img src="./assets/icons/man.png" alt="Avatar"> <br>
        <a href="index.php?page=updateProfile"> Update Password </a> <br>
    </div>
    <div class="right">
        <table>
        <tr>
            <td ><strong> Name: </strong></td> 
            <td height="50"> <?=$name; ?> </td>
        </tr>
        
        <tr>
            <td height="50"><strong> Birthdate: </strong></td> 
            <td height="50"> <?=$birthdate; ?> </td>
        </tr>
        <tr>
            <td height="50"><strong> Country: </strong></td> 
            <td height="50"> <?=$country; ?> </td>
        </tr>
        <tr>
            <td height="50"><strong> Phone Number: </strong></td> 
            <td height="50"> <?=$phone; ?> </td>
        </tr>
        <tr>
            <td height="50"><strong> E-Mail: </strong></td> 
            <td height="50"> <?=$eMail; ?> </td>
        </tr>
        </table>
    </div>
    
</div>
