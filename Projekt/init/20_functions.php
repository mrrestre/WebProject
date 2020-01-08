<?php
    require __DIR__.'/10_database.php'; 
    
    	function fetchNews( $database )
    	{
            $request = $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew FROM news JOIN user ON user.userId = news.userId ORDER BY creation DESC");
    		return $request->execute() ? $request->fetchAll() : false; 
    	}
    
        function getAnArticle( $newsId, $database )
    	{
       		$request =  $database->prepare(" SELECT newsId, newsTitle, content, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew, price FROM news JOIN user ON user.userId = news.userId WHERE newsId = ? ");
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

        function getUsersWithPermission ( $database )
        {
            $request = $database->prepare(" SELECT userId FROM user WHERE permission IS NOT NULL");
            return $request->execute() ? $request->fetchAll() : false;
        }

        function getUserIDFromLogin ( $database , $email )
        {
            $request = $database->prepare(" SELECT userId FROM user WHERE eMail = ?");
            return $request->execute(array($email)) ? $request->fetchAll() : false;
        }
        
    	// function getOtherArticles( $differ_id, $database)
    	// {
    	// 	$request =  $database->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id != ? ");
    	// 	return $request->execute(array($differ_id)) ? $request->fetchAll() : false; 
        // }
        
        // function to Delete a User by an Admin Parameter is the e-Mail of the User 

        function deleteUserFromDatabase($database, $email)
        {
            $request = $database->prepare(" DELETE user, payment_method FROM user join payment_method on user.userId = payment_method.userId WHERE user.eMail = ?");
            $request->execute(array($email)) ? $request->fetchAll() : false;
        }