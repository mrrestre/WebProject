<?
$status='';
    if(isset($_POST['submit']))
    {
        echo '1';
        // geht hier nicht rein !!!!
        if(!empty($_POST['content'])
        &&!empty($_POST['title'])
        &&!empty($_POST['teaser'])
        &&!empty($_POST['paidNews'])
        &&!empty($_POST['imagePath'])
        )
        {
            $content=    $_POST['content'];
            $title=      $_POST['title'];
            $teaser=     $_POST['teaser'];
            $paidNews=   $_POST['paidNews'];
            $copyright=  $_POST['copyright'];
            $price=      $_POST['price'];
            $imagePath=  $_POST['imagePath'];

            $request = $database->prepare("INSERT INTO news (creation, userId, content, copyright, paidNew, price, newsTitle, newsShortDescription)
                                                VALUES (:creation, :userId, :content, :copyright, :paidNew, :price, :newsTitle, :newsShortDescription)");
                
                $request->execute(['creation' => getActualDate(), // gibt fehler Zurück
                                'userId' => getUserIDFromLogin(), // gibt Fehler Zurück
                                'content' => $content,
                                'copyright' => $copyright,
                                'paidNew' => $paidNews,
                                'price' => $price,
                                'newsTitle' =>   $title ,
                                'newsShortDescription' => $teaser]);

                $status ='you were successfully registred';   
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
<form action="index.php?page=addArticle" method="post">
    <label for="content">Content*</label><br>
        <input type="textarea" id="content" name="content" placeholder="Article Content" required><br>

    <label for="copyright">Copyright</label><br>
        <input type="text" id="copyright" name="copyright" placeholder="copyright" ><br>

    <label for="title">Title*</label><br>
        <input type="text" id="title" name="title" placeholder="title" required><br>

    <label for="teaser">Teaser*</label><br>
        <input type="textarea" id="teaser" name="teaser" placeholder="teaser" required><br>
  
    <label for="paidNews">paid News*</label><br>  
                <input type="radio" value="0" id="free" name="paidNews" required>   
                <label for="free">Free //</label>
                <input type="radio" value="1" id="paid" name="paidNews" required>
                <label for="paid">Paid</label><br>
    
    <label for="price">Price</label><br>
        <input type="number"  name="price" placeholder="0.00 €" step=".01"><br>
    
    <label for="imagePath">image Path*</label><br>
        <input type="text"  name="imagePath" placeholder="imagePath: /assets/images/imgNAME " required><br>
            

    <label for="submit">
        <input type="submit" id="submit" name="submit" value="Save">
    </label>

</form>


