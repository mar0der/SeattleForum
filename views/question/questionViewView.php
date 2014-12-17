<style>
    article{
        height:150px;
        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }

</style>
<section id="content">
        <article>
            <header><a href="#"></a>
                <span><?=$this->question[0]["subject"]?></span>
                <span><?=$this->question[0]["creator"][0]["avatar"]?></span>
                <a href="#"><span><?=$this->question[0]["creator"][0]["username"]?></span></a>
                <span><?=$this->question[0]["creator"][0]["score"]?></span>
                <span><?=$this->question[0]["create_date"]?></span>
                <span><?=$this->question[0]["category_name"]?></span>
                <span><?=$this->question[0]["score"]?></span>
            </header>
            <p>
                <span><?=$this->question[0]["body"]?></span>
                <?php
                for($j = 0; $j < count($this->question[0]["tags"]); $j++) { ?>
                    <span><?=$this->question[0]["tags"][$j]["tag_name"]?>&nbsp;</span>
                <?php
                } ?>
            </p>

        </article>

    <script>
        $(document).ready(function(){
            $("#button").click(function(){
                $( "#addAnswer" ).toggle( "blind", {}, 500 );
            });

            $("#submitAnswer").click(function(){
                $("#addAnswer").hide( "blind", {}, 500 );
            });
        });
    </script>
    <button id="button">Add answer</button><br /><br />
    <article style="display:none;" id="addAnswer">
        <form action="answer/add" method="post">
            <br/>
            <label for="answerBody">Your answer:</label>
            <textarea name="answerBody" id="answerBody"></textarea><br />
            <input type="hidden" name="questionId" value="<?=$this->questionId?>" />
            <input type="submit" id="submitAnswer" value="Add">
        </form>
        <span id="error"><?= @$this->response?></span>
    </article>

    <?php
    for($i = 0; $i < count($this->answers); $i++) {
        ?>
        <article>
            <header><a href="#"></a>
                <span><?=$this->answers[$i]["creator"][0]["avatar"]?></span>
                <a href="#"><span><?=$this->answers[$i]["creator"][0]["username"]?></span></a>
                <span><?=$this->answers[$i]["creator"][0]["score"]?></span>
                <span><?=$this->answers[$i]["create_date"]?></span>
                <span><?=$this->answers[$i]["score"]?></span>
            </header>
            <p>
                <span><?=$this->answers[$i]["answer_body"]?></span>
            </p>
        </article>

    <?php } ?>
</section>
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