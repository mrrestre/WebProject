<?
$status='';
    if(isset($_POST['submit']))
    {
        
        // geht hier nicht rein // wenn das gelöst ist funktioniert das Rest einwandfrei ^_^
        // 1 als Bedingung daimt es funktioniert
        // die richtige Bedingungen sind in blabla gespeichert
        if(1)
        {
            $content=    $_POST['content'];
            $title=      $_POST['title'];
            $teaser=     $_POST['teaser'];
            $paidNews=   $_POST['paidNews'];
            $copyright=  $_POST['copyright'];
            $price=      $_POST['price'];
            $imagePath=  $_POST['imagePath'];
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

                $status ='you added an Article Successfully';   
                echo $status;
        } 
        else
        {
            $status=' all the required fields must be filled!!';
            echo $status;
        }
    }
?>

<!-- Form to let the Admin of the Website to Add an Article to the Database --> 
<form action="index.php?page=addArticle" method="POST">
    <label for="content">Content*</label><br>
        <textarea id="content" name="content" placeholder="Article Content" style="height:200px; width:400px"></textarea><br>

    <label for="copyright">Copyright</label><br>
        <input type="text" id="copyright" name="copyright" placeholder="copyright" ><br>

    <label for="title">Title*</label><br>
        <input type="text" id="title" name="title" placeholder="title" required><br>

    <label for="teaser">Teaser*</label><br>
        <textarea id="teaser" name="teaser" placeholder="Teaser" style="height:200px; width:400px"></textarea><br>
  
    <label for="paidNews">paid News*</label><br>  
                <input type="radio" value="0" id="free" name="paidNews" required>   
                <label for="free">Free //</label>
                <input type="radio" value="1" id="paid" name="paidNews" required>
                <label for="paid">Paid</label><br>
    
    <label for="price">Price</label><br>
        <input type="number"  name="price" placeholder="0.00 €" step=".01"><br>
    
    <label for="imagePath">image Path* (/assets/images/IMAGE_NAME.FILE_EXTENSIONS)</label><br>
        <input type="text"  name="imagePath" placeholder="imagePath: /assets/images/imgNAME " required><br>

    <label for="imageCopyright">image Copyright*</label><br>
        <input type="text"  name="imageCopyright" placeholder="imageCopyright" required><br>
                        

    <label for="submit">
        <input type="submit" id="submit" name="submit" value="Save">
    </label>

</form>


