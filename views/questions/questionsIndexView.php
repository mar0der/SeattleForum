<style>
    article{
        height:150px;
        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }

    header.question{
        font-size: 20px;
    }
    header.question a{
        text-decoration: none;
        color:#436fac;
    }

    p.navigation{
        padding-top:10px;
        padding-bottom: 10px;
        border-bottom: solid 1px appworkspace;
    }
    span.username-icon{
        background: url('../images/icons/question-icons.png') 0 0;
        padding-left: 25px;
    }
    span.added-time-icon{
        background: url('../images/icons/question-icons.png') 42px 0;
        padding-left: 20px;
    }

    span.tags-icon{
        background: url('../images/icons/question-icons.png') 84px 0;
        padding-left: 20px;
    }

    span.username-icon + a{
        text-decoration: none;
        font-size: 16px;
        color:#77cc51;
    }

    span.added-time-icon + a{
        text-decoration: none;
        font-size: 14px;
        color:gray;
    }

    span.tags-icon + a{
        text-decoration: none;
        font-size: 14px;
        color:gray;
    }

    span.tags-display a{
        text-decoration: none;
        font-size: 14px;
        color:#436fac;
    }
    div.counters{
        height: 60px;
        width:60px;
        display: inline-block;

    }
    div.counters div{
        height: 25px;
        width:98%;
        margin-top: 10px;
        text-align: center;
    }
    div.counters div:nth-child(1){
         border-bottom: 1px solid #000;
    }
</style>
<section id="content">

    <?php for ($i = 0; $i < count($this->allQuestions); $i++) { ?>
        <article>
            <header class="question"><a href="question/view/<?= @$this->allQuestions[$i]["question_id"] ?>"><?= @$this->allQuestions[$i]["subject"] ?></a></header>
            <p class = "navigation">
                <span class="username-icon" ></span><a href="#"><?= @$this->allQuestions[$i]["username"] ?></a>
                <span class="added-time-icon" ></span><a href="#"><?= @$this->allQuestions[$i]["create_date"] ?></a>
                <span class="tags-icon" ></span>
                <span class="tags-display">
                    <?php
                    for ($j = 0; $j < count($this->allQuestions[0]["tags"]); $j++) {
                        echo "<a href=\"/question/tag/" . $this->allQuestions[0]["tags"][$j]['tag_id'] . "\">" . $this->allQuestions[0]["tags"][$j]["tag_name"] . "&nbsp;</a>";
                    }
                    ?>
                </span>
                <br />
            <div class="counters"><div><?= $this->allQuestions[$i]["score"] ?></div> <div>Votes</div></div>
            <div class="counters"><div><?= $this->allQuestions[$i]["visites"] ?></div> <div>Visits</div></div>
            <div class="counters"><div><?= $this->allQuestions[$i]["answers_number"] ?></div> <div>Answers</div></div>
            <!--<span>Posleden otgowor: <?= $this->allQuestions[$i]["latest_answer"]["username"] ?></span>
            <span> <?= $this->allQuestions[$i]["latest_answer"]["create_date"] ?></span> -->

            <div><?php //$this->allQuestions[$i]["body"]             ?></div>
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