<?php
    require __DIR__.'/10_database.php'; 
    
    	function fetchNews( $database )
    	{
            $request = $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew FROM news JOIN user ON user.userId = news.userId ORDER BY creation DESC");
    		return $request->execute() ? $request->fetchAll() : false; 
        }

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

        function fetchNewsWithMostLikes( $database )
    	{
            $request = $database->prepare(" SELECT news.newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, likes
                                            FROM news 
                                            JOIN user ON user.userId = news.userId 
                                            ORDER BY likes DESC 
                                            LIMIT 10");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
       
        function fetchUsers( $database )
    	{
            $request = $database->prepare(" SELECT userId, concat(firstName, ' ', surname) as userName, DOB, country, phone, eMail FROM user ");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
        
        function fetchCategory( $database )
        {
            $request = $database->prepare(" SELECT catId, description FROM category ");
    		return $request->execute() ? $request->fetchAll() : false; 
        }
   
        function getAnArticle( $newsId, $database )
    	{
       		$request =  $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, content, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price FROM news JOIN user ON user.userId = news.userId WHERE newsId = ? ");
    		return $request->execute(array($newsId)) ? $request->fetchAll() : false; 
        }
        
        function getArticleImage( $newsId, $database )
        {
            $request = $database->prepare(" SELECT imagePath, copyright FROM image WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
        
        function getArticleCategory( $newsId, $database )
        {
            $request = $database->prepare(" SELECT catId FROM category_has_news WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
        
        function getArticleComments( $newsId, $database )
        {
            $request = $database->prepare(" SELECT content, concat(firstName, ' ', surname) as userName FROM comment JOIN user ON user.userId = comment.userId  WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }

        function getAllUsernamesAndPasswords ( $database )
        {
            $request = $database->prepare(" SELECT eMail, password FROM user");
            return $request->execute() ? $request->fetchAll() : false;
        }

        // Param: database and user ID
        // Return: users First Name + Last Name
        function getUserNameByID ( $database , $userId )
        {
            $request = $database->prepare(" SELECT concat(firstName, ' ', surname) as userName FROM user WHERE userId = ?");
            return $request->execute(array($userId)) ? $request->fetch() : false;
        }    

        function getUsersWithPermission ( $database )
        {
            $request = $database->prepare(" SELECT userId FROM user WHERE permission IS NOT NULL");
            return $request->execute() ? $request->fetchAll() : false;
        }

        function getUserIDByEMail ( $database , $email )
        {
            $request = $database->prepare(" SELECT userId FROM user WHERE eMail = ?");
            return $request->execute(array($email)) ? $request->fetchAll() : false;
        }
        
    	// function getOtherArticles( $differ_id, $database)
    	// {
    	// 	$request =  $database->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id != ? ");
    	// 	return $request->execute(array($differ_id)) ? $request->fetchAll() : false; 
        // }
        
        // function to Delete a User and his Payment Method Data 
        // from User and payment_method Tables by an Admin.
        // Parameter is the e-Mail of the User 

        function deleteUserFromDatabase($database, $email)
        {
            $userId = getUserIDByEMail ( $database , $email );
            $userId = $userId[0];
            $userId = $userId['userId'];

            $request = $database->prepare(" DELETE FROM payment_method  WHERE userId = ?");
            $request->execute(array($userId)) ? true : false;

            $request = $database->prepare(" DELETE FROM user  WHERE eMail = ?");
            $request->execute(array($email)) ? true : false;
        }

        // function to increase the Like counter in Database

        function likeCounterIncreasing($database, $newsId)
        {
            $request = $database->prepare(" UPDATE news SET likes = likes + 1 WHERE newsId = ?");
            $request->execute(array($newsId)) ? true : false;
        }


        // for the random number of the existing newsId:
        function getMaxAndMinIDFromNews($database)
        {
            $request = $database->prepare("SELECT MAX(newsId), MIN(newsId) FROM news");
            return $request->execute() ? $request->fetchAll() : false;
        }

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

        function getNumberOfLikes($database, $newsId)
        {
            $request = $database->prepare("SELECT likes FROM news WHERE newsId = ?");
            return $request->execute(array($newsId)) ? $request->fetchAll() : false;
        }
