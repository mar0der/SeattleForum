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

<?php
for($i = 0; $i < count($this->allQuestions); $i++) {
?>
    <article>
        <header><a href="question/view/<?=$this->allQuestion[$i]["question_id"]?>"><?=$this->allQuestions[$i]["subject"]?></a></header>
        <p>
            <span><?=$this->allQuestions[$i]["avatar"]?></span>
            <a href="#"><?=$this->allQuestions[$i]["username"]?></a>
            <span><?=$this->allQuestions[$i]["create_date"]?></span>
            <span><?=$this->allQuestions[$i]["score"]?></span>
            <span><?=$this->allQuestions[$i]["visites"]?></span>
            <span><?=$this->allQuestions[$i]["answers_number"]?></span>
            <span>Posleden otgowor: <?=$this->allQuestions[$i]["latest_answer"]["username"]?></span>
            <span> <?=$this->allQuestions[$i]["latest_answer"]["create_date"]?></span>
        </p>
        <div><?php //$this->allQuestions[$i]["body"]?></div>
    </article>

    <?php } ?>
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