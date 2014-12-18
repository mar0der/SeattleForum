<style>
    article{

        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }

    textarea{
        height:200px;
        width: 400px;
        padding-top: 10px;
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
            <label for="tags">Tags (, separated):</label>
            <input type="text" id="tags" name="tags" /><br />
            <input type="hidden" name="categoryId" value="<?= $this->categoryId ?>" />
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