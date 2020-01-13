<?php
$status='';
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['content'])
        &&!empty($_POST['title'])
        &&!empty($_POST['teaser'])
        &&isset($_POST['paidNews'])
        &&!empty($_POST['imageName'])
        &&!empty($_POST['imageCopyright'])
        )

        {
            $content=    $_POST['content'];
            $title=      $_POST['title'];
            $teaser=     $_POST['teaser'];
            $paidNews=   $_POST['paidNews'];
            $copyright=  $_POST['copyright'];
            $price=      $_POST['price'];
            $imagePath=  $_POST['imageName'];
            $imageCopyright= $_POST['imageCopyright'];

            $request = $database->prepare("INSERT INTO news (creation, userId, content, copyright, paidNew, price, newsTitle, newsShortDescription)
                                                VALUES (:creation, :userId, :content, :copyright, :paidNew, :price, :newsTitle, :newsShortDescription)");
                
                $request->execute(['creation' => date("Y-m-d"),
                                'userId' => $_SESSION['currentUser'],
                                'content' => $content,
                                'copyright' => $copyright,
                                'paidNew' => $paidNews,
                                'price' => $price,
                                'newsTitle' =>   $title ,
                                'newsShortDescription' => $teaser]);

            // $lastId to return the last inserted Id in news Table to insert it in the Image table
            $lastId = $database->lastInsertId();
                

            // insert an Image path with imageName.jpg/png... && imageCopyright && the newsId to the image Table in Database
            $request = $database->prepare("INSERT INTO image (imagePath, copyright, newsId)
                                                VALUES (:imagePath, :copyright, :newsId)");
                $request->execute(['imagePath' => $imagePath,
                                   'copyright' => $imageCopyright,
                                   'newsId' => $lastId]);

             

            // add Category to the news
            $categoryDescription = fetchCategory( $database );
            $category = $_POST['category'];
            foreach($category as $selected)
            {
                foreach($categoryDescription as $row)
                {
                    if($selected === $row['description'])
                    {
                        $catId = $row['catId'];
                        $request = $database->prepare("INSERT INTO category_has_news (catId, newsId)
                                                    VALUES (:catId, :newsId)");
                        $request->execute(['catId' => $catId,
                                          'newsId' => $lastId]);
                    }
                }
            }

                $status ='You added an Article Successfully';   
                echo $status;
        } 
        else
        {
            $status='All the required fields must be filled!!';
            echo $status;
        }
    }
?>

<!-- Form to let the Admin of the Website Add an Article to the Database --> 
<html>
<head>
        <!-- hier den css von addArticle hinzüfugen -->
</head>
<body>
    <form action="index.php?page=addArticle" method="POST">

        <label for="title">Title*</label><br>
        <input type="text" id="title" name="title" placeholder="title" required><br>

        <label for="teaser">Teaser*</label><br>
        <textarea id="teaser" name="teaser" placeholder="Teaser" style="height:100px; width:400px"></textarea><br>
        
        <label for="content">Content*</label><br>
        <textarea id="content" name="content" placeholder="Article Content" style="height:200px; width:400px"></textarea><br>

        <label for="copyright">Copyright</label><br>
        <input type="text" id="copyright" name="copyright" placeholder="copyright" ><br>

        <p>Choose one or more Category: 
        <input type="checkbox" id="IOS" name="category[]" value="IOS"> <label for="IOS">IOS</label>
        <input type="checkbox" id="Android" name="category[]" value="Android"> <label for="Android">Android</label>
        <input type="checkbox" id="Apple" name="category[]" value="Apple"> <label for="Apple">Apple</label>
        <input type="checkbox" id="Windows" name="category[]" value="Windows"> <label for="Windows">Windows</label>
        <input type="checkbox" id="Wearables" name="category[]" value="Wearables"> <label for="Wearables"> Wearables</label>
        <input type="checkbox" id="Audio" name="category[]" value="Audio">  <label for="Audio">Audio</label>
        <input type="checkbox" id="ChromeOS" name="category[]" value="ChromeOS">  <label for="ChromeOS">Chrome OS</label> </p>
        
    
        <label for="paidNews">Payed Article?*</label><br>  
        <input type="radio" value="0" id="free" name="paidNews" required checked>   
        <label for="free">Free</label> //
        <input type="radio" value="1" id="paid" name="paidNews" required>
        <label for="paid">Paid</label><br>
        
        <label for="price">Price</label><br>
        <input type="number" id="price" name="price" placeholder="0.00 €" step=".01">€<br>
        
        <label for="imageName">image Name* (IMAGE_NAME.FILE_EXTENSIONS)</label><br>
        <input type="text" name="imageName"  id="imageName" placeholder="Image Name" required><br>

        <label for="imageCopyright">image Copyright*</label><br>
        <input type="text" name="imageCopyright" id="imageCopyright" placeholder="imageCopyright" required><br>
                            

        <label for="submit">
        <input type="submit" id="submit" name="submit" value="Save">
        </label>

    </form>
</body>
</html>


