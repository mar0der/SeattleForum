<style>
    article{

        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }


    input[type="text"], textarea, select {
        color: #555;
        height: 30px;
        line-height:15px;
        width: 550px;
        padding: 0px 0px 0px 10px; 
        margin-left:0;
        margin-top: 2px;
        border: 1px solid #436fac;
        background: #FBFBFB;
        outline: 0;
        -webkit-box-shadow: inset 1px 1px 2px rgba(238, 238, 238, 0.2);
        box-shadow: inset 1px 1px 2px rgba(238, 238, 238, 0.2);
        font: normal 14px/14px Arial, Helvetica, sans-serif;
    }

    textarea{
        height:200px;
        padding-top: 10px;
        margin-top:10px;
    }
    input[type=submit]{
        margin-left:0px;
        margin-top: 10px;
        padding: 4px 25px;
    }
    
    #categoriesSelect{
        width:560px;
        margin-left:0;
        margin-bottom:10px;
        border: 1px solid #436fac;
    }

</style>
<section id="content">
    <article>
        <form action="question/ask" method="post">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" />
            <br/>
            <label for="questionBody">Your question:</label>
            <textarea name="questionBody" id="questionBody"></textarea>
            <br />
            <label for="categories">Categories:</label>
            <select id="categoriesSelect">
                <?php for($i = 0; $i < count($this->allCategories); $i++) {
                    echo "<option value=\"".$this->allCategories[$i]['category_id']."\">".$this->allCategories[$i]['category_name']."</option>";
                } ?>
            </select>
            <br/>
            <label for="tags">Tags:</label>
            <input type="text" id="tags" name="tags" placeholder="Comma separated"/><br />
            <input type="hidden" name="categoryId" value="<?= $this->categoryId ?>" />
            <label for="submit"></label>
            <input type="submit" value="Ask">
        </form>
        <span id="error"><?= @$this->response ?></span>
    </article>
</section>
<aside id="categories">
    <header>Categories:</header>
    <ul class="categories">
        <?php for ($i = 0; $i < count($this->allCategories); $i++) { ?>
            <li><a href="/questions/category/<?= @$this->allCategories[$i]["category_id"] ?>"><?= @$this->allCategories[$i]["category_name"] ?></a><span class="notification"><?= $this->allCategories[$i]["questions_number"] ?></span></li>
        <?php } ?>
    </ul>
</aside>
<aside id="tags">
    <header>Tags:</header>
    <?php for ($i = 0; $i < count($this->allTags); $i++) { ?>
        <a href="/questions/tag/<?= @$this->allTags[$i]["tag_id"] ?>" class="tags"><?= @$this->allTags[$i]["tag_name"] ?></a>
        <?php
    }
    ?>
</aside>