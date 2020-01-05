<?php
    require __DIR__.'/10_database.php'; 
    
    	function fetchNews( $database )
    	{
            $request = $database->prepare(" SELECT newsId, newsTitle, newsShortDescription, concat(firstName, ' ', surname) as authorName, creation, updated, copyright, paidNew FROM news JOIN user ON user.userId = news.userId ORDER BY creation DESC");
    		return $request->execute() ? $request->fetchAll() : false; 
    	}
    
        function getAnArticle( $newsId, $database )
    	{
       		$request =  $database->prepare(" SELECT newsId, newsTitle, content, concat(firstName, surname) as authorName, creation, updated, copyright, paidNew, price FROM news JOIN user ON user.userId = news.userId WHERE newsId = ? ");
    		return $request->execute(array($newsId)) ? $request->fetchObject() : false; 
        }
        
        function getArticleImage( $newsId, $database )
        {
            $request = $database->prepare(" SELECT imagePath, copyright FROM image WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchObject() : false;
        }
        
        function getArticleCategory( $newsId, $database )
        {
            $request = $database->prepare(" SELECT catId FROM category_has_news WHERE newsId = ? ");
            return $request->execute(array($newsId)) ? $request->fetchObject() : false;
        }
    
    	// function getOtherArticles( $differ_id, $database)
    	// {
    	// 	$request =  $database->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id != ? ");
    	// 	return $request->execute(array($differ_id)) ? $request->fetchAll() : false; 
    	// }