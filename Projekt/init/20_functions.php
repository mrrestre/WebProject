<?php
    require __DIR__.'/10_database.php'; 
    
        // Returns all the news from Datase
    	function fetchNews( $database )
    	{
            $request = $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew 
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            ORDER BY creation DESC");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

        // Returns the top 10 news (Most comments)
        function fetchNewsWithMostComments( $database )
    	{
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, count(comment.newsId) as nmComments
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
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, likes
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            ORDER BY likes DESC 
                                            LIMIT 10");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

        // Returns a true if a there are not Registered Users with that email
        function isEmailAvailable ( $database, $email) {
            $request =  $database->prepare(" SELECT * FROM user WHERE eMail = ? ");
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

            $sqlQuery = "SELECT DISTINCT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew 
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
            $request = $database->prepare(" SELECT userId, concat(firstName, ' ', surname) as userName, DOB, country, phone, eMail 
                                            FROM user ");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
        
        // Returns the articles from a given category
        function getArticlesFromCategory ($category, $database){
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew 
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

        // Returns an User with the given Email
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
                        return $random;
                        break;
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
