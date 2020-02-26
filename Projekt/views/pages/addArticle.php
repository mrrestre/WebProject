<?php
$status='';
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['content'])
        &&!empty($_POST['title'])
        &&!empty($_POST['teaser'])
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

<body>
    <div class="All">
    <h5> Add an Article</h5>
    <table>
    <form name="addArticle" action="index.php?page=addArticle" method="POST" onsubmit="return addArticleFormValidation()">

        <tr>
        <td><label for="title">Title*</label></td>
        <td><input type="text" id="title" name="title" placeholder="Title" value="<?php if(isset($_POST['title'])) echo htmlspecialchars($_POST['title']);?>" required></td>
        </tr>

        <tr>
        <td><label for="teaser">Teaser*</label></td>
        <td><textarea id="teaser" name="teaser" placeholder="Teaser" value="<?php if(isset($_POST['teaser'])) echo htmlspecialchars($_POST['teaser']);?>"></textarea></td>
        </tr>
        
        <tr>
        <td><label for="content">Content*</label></td>
        <td><textarea id="content" name="content" placeholder="Article Content" class="content" value="<?php if(isset($_POST['content'])) echo htmlspecialchars($_POST['content']);?>"></textarea></td>
        </tr>

        <tr>
        <td><label for="copyright">Copyright</label></td>
        <td><input type="text" id="copyright" name="copyright" placeholder="Copyright" value="<?php if(isset($_POST['copyright'])) echo htmlspecialchars($_POST['copyright']);?>"></td>
        </tr>

        <tr>
        <td>
        <p>
            Categories: </td>
            <div class="posibilities">
                <td>
                    <input type="checkbox" id="IOS" name="category[]" value="IOS"> <label for="IOS">IOS</label>
                    <input type="checkbox" id="Android" name="category[]" value="Android"> <label for="Android">Android</label>
                    <input type="checkbox" id="Apple" name="category[]" value="Apple"> <label for="Apple">Apple</label>
                    <input type="checkbox" id="Windows" name="category[]" value="Windows"> <label for="Windows">Windows</label>
                    <input type="checkbox" id="Wearables" name="category[]" value="Wearables"> <label for="Wearables"> Wearables</label>
                    <input type="checkbox" id="Audio" name="category[]" value="Audio">  <label for="Audio">Audio</label>
                    <input type="checkbox" id="ChromeOS" name="category[]" value="Chrome OS">  <label for="ChromeOS">Chrome OS</label> 
                </td>
            </div>
        </p> 
                         
        
        </tr>
        
    
        <tr>
        <td><label for="paidNews">Payed Article?*</label></td>  
        <td><input type="radio" value="0" id="free" name="paidNews" required checked>   
        <label for="free">Free</label> //
        <input type="radio" value="1" id="paid" name="paidNews" required>
        <label for="paid">Paid</label></td>
        </tr>
        
        <tr>
        <td><label for="price">Price</label></td>
        <td><input type="number" id="price" name="price" placeholder="0.00 €" step=".01" value="<?php if(isset($_POST['price'])) echo htmlspecialchars($_POST['price']);?>"></td>
        </tr>
        
        <tr>
        <td><label for="imageName">Image Name* <br><span>(imageName.fileExtention)</span></label></td>
        <td><input type="text" name="imageName"  id="imageName" placeholder="Image Name" value="<?php if(isset($_POST['imageName'])) echo htmlspecialchars($_POST['imageName']);?>" required></td>
        </tr>

        <tr>
        <td><label for="imageCopyright">Image Copyright*</label></td>
        <td><input type="text" name="imageCopyright" id="imageCopyright" placeholder="image Copyright" value="<?php if(isset($_POST['imageCopyright'])) echo htmlspecialchars($_POST['imageCopyright']);?>" required></td>
        </tr>
                            

        <tr>
        <td colspan="2"><label for="submit">
        <input type="submit" id="submit" name="submit" value="Save" class="submitForm">
        </label></td>
        </tr>

    </form>
    </table>
    </div>
</body>
</html>


