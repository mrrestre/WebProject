<?php
    $counter = 0;
    $userid = '';
    //Gets the current Logged User (If existing)
    if(isset($_SESSION['currentUser'])){
        $userid = $_SESSION['currentUser'];
    }
    //Gets this user Payment methods
    $paymentMethods = getPaymentMethods ($userid, $database);

    // Which new is he buying
    $newsid = $_GET['newsid'];
    $article = getAnArticle($newsid, $database);
    $article = $article[0];

    if(isset($_POST['buySubmit'])){
        
        // Card Type Credit        
        if($_POST['cardType'] == 1){
            
            $cardNumber = $_POST['cardNumber']; 
            $cardCVV = getCVV ($userid, $database, $cardNumber);
            $cardCVV = $cardCVV[0];
            
            $givenCCV = $_POST['CVV']; 

            // To be sure that the given CCV and the one stored on the database are the same
            if($cardCVV == $givenCCV){
                $request = $database->prepare("INSERT INTO purchased_article (newsId, userId)
                                            VALUES (:newsId, :userId)");
                $request->execute(['newsId' => $newsid,
                                    'userId' => $userid ]);
                
                echo 'Buyed Succesfully!';
                $link = 'index.php?page=readArticle&newsid='.$newsid;
                header("Location: $link");
            }
            else {
                echo 'Wrong CVV';
            } 
        }
        // Card Type Debit (No CVV)
        elseif ($_POST['cardType'] == 0) {
            $request = $database->prepare("INSERT INTO purchased_article (newsId, userId)
                                        VALUES (:newsId, :userId)");
            $request->execute(['newsId' => $newsid,
                                'userId' => $userid ]);
            
            echo 'Buyed Succesfully!';
            $link = 'index.php?page=readArticle&newsid='.$newsid;
            header("Location: $link");
        }
    }
    
    //Add a new Card
    if(isset($_POST['addSubmit']))
    { 
        if(!empty($_POST['nameOnCard'])
        &&!empty($_POST['cardType'])
        &&!empty($_POST['cardNumber'])){
            
            $nameOnCard = $_POST['nameOnCard'];
            $cardType = $_POST['cardType'];
            $cardNumber = $_POST['cardNumber'];

            // Adding a Credit Card
            if($cardType == 'c'){
                
                $cardType = 1;

                if(!empty($_POST['CVV'])){
                    
                    $CVV = $_POST['CVV'];

                    $request = $database->prepare("INSERT INTO payment_method (userId, cardType, cardNumber, CVV, nameOnCard)
                                                    VALUES (:userId, :cardType, :cardNumber, :CVV, :nameOnCard)");

                    $request->execute(['userId' => $userid, 
                                        'cardType'=> $cardType, 
                                        'cardNumber' => $cardNumber,
                                        'CVV' => $CVV,
                                        'nameOnCard' => $nameOnCard]);
                    echo 'Card succesfully added';
                }
                else{
                    echo 'Credit Cards Require a CCV!';
                }
            }
            // Adding a Debit Card (No CCV)
            else {
                if(empty($_POST['CVV'])){

                    $cardType = 0;
                    
                    $CVV = $_POST['CVV'];

                    $request = $database->prepare("INSERT INTO payment_method (userId, cardType, cardNumber, CVV, nameOnCard)
                                                    VALUES (:userId, :cardType, :cardNumber, :CVV, :nameOnCard)");

                    $request->execute(['userId' => $userid, 
                                        'cardType'=> $cardType, 
                                        'cardNumber' => $cardNumber,
                                        'CVV' => $CVV,
                                        'nameOnCard' => $nameOnCard]);
                    echo 'Card succesfully added';
                } 
                else{
                    echo 'Debit Cards dont have CVV';
                }
            }
        }
        else {
            echo 'All Field musst be filled';
        }

    }

    // In Order to Display the saved Payment methods of this user
    if(isset($paymentMethods)){
        $paymentMethods = getPaymentMethods ($userid, $database);
    }

?>

<html>
    <body>
        <div class="megaContainer">
            <h5> Buying article: <?=$article['newsTitle']?> </h5>
            <div class="container">
                <div class="addPayment">
                    <form action="index.php?page=buyArticle&newsid=<?=$newsid?>" method="POST"> 
                        <h3>Add a New Payment Method</h3>   
                        <table width="100%">  
                            <tr>   
                                <td><label for="cardType">Card Type:* </label></td>  
                                <td><input type="radio" value="c" id="Credit" name="cardType" required>   
                                <label for="Credit">Credit Card</label>
                                <input type="radio" value="d" id="Debit" name="cardType" required>
                                <label for="Debit">Debit Card</label></td>
                            </tr>

                            <tr>
                                <td><label for="cardNumber">Card Number:* </label></td>
                                <td><input type="number" id="cardNumber" name="cardNumber" placeholder="Card Number" required></td>
                            </tr>

                            <tr>             
                                <td><label for="nameOnCard">Name on Card:* </label></td>
                                <td><input type="text" id="nameOnCard" name="nameOnCard" placeholder="Name on Card" required></td>
                            </tr>
                            
                            <tr>
                                <td><label for="CVV">CVV:* </label></td>
                                <td><input type="password" id="CVV" name="CVV"></td>
                            </tr>
                        </table>
                        <label for="submit">
                            <input type="submit" class="addSubmit" id="addSubmit" name="addSubmit" value="Submit">
                        </label>
                    </form>
                </div>
                <?php foreach($paymentMethods as $row) { ?>
                <div class="paymentM">

                    <form action="index.php?page=buyArticle&newsid=<?=$newsid?>" method="POST">                 
                        <table width="100%">  
                            <h3>Or use an existing one</h3>             
                            <tr>
                                <td><label for="nameOnCard">Name on Card: </label></td>
                                <td><span id='nameOnCard' name='nameOnCard'><?=$row['nameOnCard'];?></span></td>
                            </tr>
                            <tr>
                                <td><label for="cardType">Card Type: </label></td>
                                <td><span id='cardType' name='cardType' value="<?php if($row['cardType'] == 1){echo '1';} else {echo '0';}?>"><?php if($row['cardType'] == 1){echo 'Credit Card';} else {echo 'Debit Card';}?></span> </td>
                            </tr>
                            <tr>
                                <td><label for="cardNumber">Card Number: </label></td>
                                <td><span id='cardNumber' name='cardNumber' value='<?=$row['cardNumber'];?>'><?=$row['cardNumber'];?></span></td>
                            </tr>

                            <?php 
                                // For Credit Card
                                if($row['cardType'] == 1) {
                                    echo '<tr>
                                            <td><label for="cardNumber">CCV*: </label></td>
                                            <td><input type="password" id="CVV" name="CVV"></td>
                                        </tr>';
                                }
                            ?>
                        </table>

                        

                        <div class="buyArticle">
                            <label for="submit">
                                <input type="submit" class="buySubmit" id="buySubmit" name="buySubmit" value="Buy">
                            </label>
                        </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
        
    </body>
</html>