<?php
    require __DIR__.'/10_database.php'; 
    
        // Returns all the news from Datase
    	function fetchNews( $database )
    	{
            $request = $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price 
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            ORDER BY creation DESC");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

        // Returns true if this user has alredy bought this article
        function hasUserBuyedThisArticle ($userId, $newsId, $database){
            $request = $database->prepare(" SELECT newsId, userId 
                                            FROM purchased_article ");
            $request->execute();
            $result = $request->fetchAll();
            
            foreach ($result as $row){
                if(($row['newsId'] == $newsId) && ($row['userId'] == $userId)){
                    $found = true;
                    break;
                }
                else{
                    $found = false;
                }
            } 
            return $found;
        }

        // Return true if Article is a Paid article
        function isAPaidArticle ($newsid, $database)
        {
            $request = $database->prepare(" SELECT paidNew 
                                            FROM news
                                            WHERE newsId = ?");
            $request->execute(array($newsid));
            $result = $request->fetchAll();
            
            foreach ($result as $row){
                if($row['paidNew'] == 1){
                    return true;
                }
                else{
                    return false;
                }
            } 
        }

        // Decides depending if the user has already bought an article what happen when he/she click on the article
        function whereShouldTheLinkTakeMeTo ($row, $database){
            $userid = '';
            $href = '';
            $userBoughtThisNew = '';
            $newsid = $row['newsId'];
            if(isset($_SESSION['currentUser'])){
                $userid = $_SESSION['currentUser'];
            }
            else {
                $userid = '-1';
            }

            //its a free new
            if($row['paidNew'] == 0){
                $href = "index.php?page=readArticle&newsid=".$row['newsId'];
            }
            //Paid new
            elseif($row['paidNew'] == 1){
                $userBoughtThisNew = hasUserBuyedThisArticle($userid, $newsid, $database);
                // Not signed in
                if($userid == -1){
                    $href = "index.php?page=login";
                }
                // Signed in but has not buyed it
                elseif ($userBoughtThisNew == false){
                    $href = "index.php?page=buyArticle&newsid=".$row['newsId'];
                }
                else {
                    $href = "index.php?page=readArticle&newsid=".$row['newsId'];
                }
            }
            return $href;
        }

        // Gets the Payment Method from a person
        function getPaymentMethods ($userid, $database) {
            $request = $database->prepare(" SELECT cardType, cardNumber, nameOnCard
                                            FROM payment_method 
                                            WHERE userId = ? ");
    		return $request->execute(array($userid)) ? $request->fetchAll() : false; 
        }

        // Gets the CVV from a Persons Payment Method
        function getCVV ($userid, $database, $cardNumber) {
            $request = $database->prepare(" SELECT CVV
                                            FROM payment_method 
                                            WHERE userId = :userid AND cardNumber = :cardNumber ");
    		return $request->execute(array( 'userid' => $userid,
                                            'cardNumber' => $cardNumber)) ? $request->fetchAll() : false; 
        }

        // Returns the top 10 news (Most comments)
        function fetchNewsWithMostComments( $database )
    	{
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price, count(comment.newsId) as nmComments
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            JOIN comment ON news.newsId = comment.newsId
                                            GROUP BY comment.newsId
                                            ORDER BY nmComments DESC 
                                            LIMIT 10");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

        

        // Returns the top 10 news (Most Likes)
        function fetchNewsWithMostLikes( $database )
    	{
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price, likes
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            ORDER BY likes DESC 
                                            LIMIT 10");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

        // Returns a true if a there are not Registered Users with that email
        function isEmailAvailable ( $database, $email) {
            $request =  $database->prepare(" SELECT * 
                                                FROM user 
                                                WHERE eMail = ? ");
            $request->execute(array($email)); 

            if($request->rowCount() > 0){
                return false;
            }
            else{
                return true;
            }
        }

        // Returns true if the password is safe
        function isPasswordSafe ( $candidate ) {
            $r1='/[A-Z]/';  //Uppercase
            $r2='/[a-z]/';  //lowercase
            $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  //special char
            $r4='/[0-9]/';  //numbers
            
            if(preg_match_all($r1,$candidate, $o) < 1) return FALSE;
            
            if(preg_match_all($r2,$candidate, $o) < 1) return FALSE;
            
            if(preg_match_all($r3,$candidate, $o) < 1) return FALSE;
            
            if(preg_match_all($r4,$candidate, $o) < 1) return FALSE;
            
            if(strlen($candidate) < 8) return FALSE;
            
            return TRUE;
        }

        // Searches in news.content and newTitle and Author and category description for given parameter
        function searchWithParameter($parameter, $database){

            $sqlQuery = "SELECT DISTINCT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price 
                            FROM news 
                            JOIN user ON user.userId = news.userId
                            JOIN category_has_news ON news.newsId = category_has_news.newsId
                            JOIN category ON category_has_news.catId = category.catId
                            WHERE (content like :parameter1) or (newsTitle like :parameter2) or (category.description like :parameter3) or (firstName like :parameter4)  
                            ORDER BY creation DESC";

            $request = $database->prepare($sqlQuery);
            
            $request->execute(array(    'parameter1' => '%'.$parameter.'%',
                                        'parameter2' => '%'.$parameter.'%',
                                        'parameter3' => '%'.$parameter.'%',
                                        'parameter4' => '%'.$parameter.'%')); 
            
            if(isset($request)){
                return $request->fetchAll();
            }
            else {
                return false;
            }
        }
        
        // Returns all users from Database
        function fetchUsers( $database )
    	{
            $request = $database->prepare(" SELECT userId, concat(firstName, ' ', surname) as userName, DOB, country, phone, eMail, gender 
                                            FROM user ");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
        
        // Returns the articles from a given category
        function getArticlesFromCategory ($category, $database){
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price 
                                            FROM news 
                                            JOIN user ON user.userId = news.userId
                                            JOIN category_has_news ON news.newsId = category_has_news.newsId
                                            JOIN category ON category_has_news.catId = category.catId
                                            WHERE category.description = ?
                                            ORDER BY creation DESC ");
    		return $request->execute(array($category)) ? $request->fetchAll() : false; 
        }

        // Returns each category from Database
        function fetchCategory( $database )
        {
            $request = $database->prepare(" SELECT catId, description 
                                            FROM category ");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
   
        // Returns an Article with a given ID
        function getAnArticle( $newsId, $database )
    	{
       		$request =  $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, content, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price 
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            WHERE newsId = ? ");
    		return $request->execute(array($newsId)) ? $request->fetchAll() : false; 
        }
        
        // Returns the Image Path of a given article
        function getArticleImage( $newsId, $database )
        {
            $request = $database->prepare(" SELECT imagePath, copyright 
                                            FROM image 
                                            WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
        
        // Returns the categories of an Article
        function getArticleCategory( $newsId, $database )
        {
            $request = $database->prepare(" SELECT catId 
                                            FROM category_has_news 
                                            WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
        
        // Returns the comments from an Article 
        function getArticleComments( $newsId, $database )
        {
            $request = $database->prepare(" SELECT content, concat(firstName, ' ', surname) as userName 
                                            FROM comment 
                                            JOIN user ON user.userId = comment.userId  
                                            WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }

        // Fetches the Users an their Passwords
        function getAllUsernamesAndPasswords ( $database )
        {
            $request = $database->prepare(" SELECT eMail, password 
                                            FROM user");
            return $request->execute() ? $request->fetchAll() : false;
        }

        // Param: database and user ID
        // Return: users First Name + Last Name
        function getUserNameByID ( $database , $userId )
        {
            $request = $database->prepare(" SELECT concat(firstName, ' ', surname) as userName 
                                            FROM user 
                                            WHERE userId = ?");
            return $request->execute(array($userId)) ? $request->fetch() : false;
        }    

        // Returns the user which are Admins
        function getUsersWithPermission ( $database )
        {
            $request = $database->prepare(" SELECT userId 
                                            FROM user 
                                            WHERE permission IS NOT NULL");
            return $request->execute() ? $request->fetchAll() : false;
        }

        // Returns an UserID with the given Email
        function getUserIDByEMail ( $database , $email )
        {
            $request = $database->prepare(" SELECT userId 
                                            FROM user 
                                            WHERE eMail = ?");
            return $request->execute(array($email)) ? $request->fetchAll() : false;
        }

        // Deletes an User with a given Email
        function deleteUserFromDatabase($database, $email)
        {
            $userId = getUserIDByEMail ( $database , $email );
            $userId = $userId[0];
            $userId = $userId['userId'];

            $request = $database->prepare(" DELETE FROM payment_method  
                                            WHERE userId = ?");
            $request->execute(array($userId)) ? true : false;

            $request = $database->prepare(" DELETE FROM user  
                                            WHERE eMail = ?");
            $request->execute(array($email)) ? true : false;
        }

        // function to increase the Like counter in Database
        function likeCounterIncreasing($database, $newsId)
        {
            $request = $database->prepare(" UPDATE news 
                                            SET likes = likes + 1 
                                            WHERE newsId = ?");
            $request->execute(array($newsId)) ? true : false;
        }


        // for the random number of the existing newsId:
        function getMaxAndMinIDFromNews($database)
        {
            $request = $database->prepare("SELECT MAX(newsId), MIN(newsId) 
                                            FROM news");
            return $request->execute() ? $request->fetchAll() : false;
        }

        // Returns a random ID from articles
        function getRandomNumberFromIdRange($database)
        {
            $request = getMaxAndMinIDFromNews($database);
            $request = $request[0];
            if(isset($request['MAX(newsId)']) && isset($request['MIN(newsId)']))
            {
                $maxId = $request['MAX(newsId)'];
                $minId = $request['MIN(newsId)'];
                while(1)
                {
                    $random=rand($minId ,$maxId);
                    $article = getAnArticle( $random, $database );
                    if($article)
                    {
                        $article = $article[0];
                        if($article['paidNew'] == 0){
                            return $random;
                            break;
                        }
                    }
                }
            }
            
        }

        //Returns how many likes does a new has
        function getNumberOfLikes($database, $newsId)
        {
            $request = $database->prepare("SELECT likes 
                                            FROM news 
                                            WHERE newsId = ?");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
