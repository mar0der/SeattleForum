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

    div.last-answer{
        display: inline-block;
        height: 40px;
        border-left: 1px solid gray;
        margin-top: 15px;
        vertical-align: top;
        padding-left:10px;
        padding-top:10px;
    }
    a.last-answerer{
        text-decoration: none;
        color: #436fac;
    }

    span.last-answer-time{
        font-size: 14px;
        color:gray; 
    }
</style>
<script>
    function voteUp(questionId) {
        $.post("questions/ajaxvote", {vote: "1", questionId: questionId}, function(data) {
            $("#scoring-"+questionId).html(data);
        });
    }

    function voteDown(questionId) {
        $.post("questions/ajaxvote", {vote: "-1", questionId: questionId}, function(data) {
            $("#scoring"+questionId).html(data);
        });
    }
</script>
<section id="content">

    <?php for ($i = 0; $i < count($this->allQuestions); $i++) { ?>
        <article>
            <a href="#" id="voteUp" onclick="voteUp(<?= @$this->allQuestions[$i]["question_id"] ?>)">VoteUp</a>
            <a href="#" id="voteDown" onclick="voteDown(<?= @$this->allQuestions[$i]["question_id"] ?>)">VoteDown</a>
            <div id="result"></div>
            <header class="question"><a href="question/view/<?= @$this->allQuestions[$i]["question_id"] ?>"><?= @$this->allQuestions[$i]["subject"] ?></a></header>
            <p class = "navigation">
                <span class="username-icon" ></span><a href="/user/profile/<?= @$this->allQuestions[$i]["userid"] ?>"><?= @$this->allQuestions[$i]["username"] ?></a>
                <span class="added-time-icon" ></span><a href="#"><?= @$this->allQuestions[$i]["create_date"] ?></a>
                <span class="tags-icon" ></span>
                <span class="tags-display">
                    <?php
                    for ($j = 0; $j < count($this->allQuestions[0]["tags"]); $j++) {
                        echo "<a href=\"/questions/tag/" . $this->allQuestions[0]["tags"][$j]['tag_id'] . "\">" . $this->allQuestions[0]["tags"][$j]["tag_name"] . "&nbsp;</a>";
                    }
                    ?>
                </span>
                <br />
            </p>
            <div class="counters" id="scoring-<?= @$this->allQuestions[$i]["question_id"] ?>"><div><?= $this->allQuestions[$i]["score"] ?></div> <div>Votes</div></div>
            <div class="counters"><div><?= $this->allQuestions[$i]["visites"] ?></div> <div>Visits</div></div>
            <div class="counters"><div><?= $this->allQuestions[$i]["answers_number"] ?></div> <div>Answers</div></div>
            <div class="last-answer"> Last answer:
                <span><a href="/user/profile/<?= @$this->allQuestions[$i]["latest_answer"]["userid"] ?> " class = "last-answerer"><?= $this->allQuestions[$i]["latest_answer"]["username"] ?></a></span>
                on <span class="last-answer-time"><?= $this->allQuestions[$i]["latest_answer"]["create_date"] ?></span>
            </div>
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