<style>
    aside {
        width: 180px;
        float: left;
        clear: left;
        background-color:bisque;
        border-radius: 10px;
        border: 1px solid #436fac;
        display: inline-block;
        padding:10px;
    }

    aside#tags{
        margin-top: 20px;
    }

    section#questions{
        width:780px;
        float: right;
        vertical-align: middle;
    }

    article{
        height:150px;
        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }

</style>
<section id="questions">
    <form action="question/ask" method="post">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" />
        <br/>
        <label for="questionBody">Your question:</label>
        <textarea name="questionBody" id="questionBody"></textarea><br />
        <label for="tags">Tags (write them in with ',' between, all spaces will be ignored)</label>
        <input type="text" id="tags" name="tags" /><br />
        <input type="hidden" name="categoryId" value="<?=$this->categoryId?>" />
        <input type="submit" value="Ask">
    </form>
    <span id="error"><?= @$this->response?></span>
</section>
<aside id="categories">
    <h4>Categories</h4>
    <ul>
        <?php for($i = 0; $i < count($this->allCategories); $i++) { ?>
            <li><?=$this->allCategories[$i]["category_name"]?><span><?=$this->allCategories[$i]["questions_number"]?></span></li>
        <?php
        }
        ?>
    </ul>
</aside>
<aside id="tags">
    <h4>Tags</h4>
    <?php for($i = 0; $i < count($this->allTags); $i++) { ?>
        <a href=""><?=$this->allTags[$i]["tag_name"]?></a>
    <?php
    }
    ?>
</aside>