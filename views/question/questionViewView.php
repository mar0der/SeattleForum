<style>
    article{
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
        background: url('/images/icons/question-icons.png') 0 0;
        padding-left: 25px;
    }
    span.added-time-icon{
        background: url('/images/icons/question-icons.png') 42px 0;
        padding-left: 20px;
    }

    span.tags-icon{
        background: url('/images/icons/question-icons.png') 84px 0;
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
        width:59px;
        display: inline-block;
        margin-left: 20px;
    }
    div.counters > div {
        height:30px;
        padding-top:7px
    }

    div.counters div:nth-child(1){
        border-bottom: 1px solid #000;
    }
    div.counters div span:nth-child(1){
        margin-right:10px;
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
    /* question post style */
    #profile-left{
        width: 15%;
        display: inline-block;
        padding:10px;
    }
    #profile-right{
        width: 84%;
        display:inline-block;
        margin-top:10px;
        vertical-align: top;
        padding-left: 5px;
        border-left: 1px solid gray;
    }
    .add-btn{
        color: #FFF;
        margin-left: 15px;
        background-color: red;
        font-family: Arial, sans-serif;
        line-height: 16px;
        padding: 0 7px;
        border-radius: 10px;
        text-shadow: 0 1px rgba(0, 0, 0, 0.25);
        border: 1px solid;
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        background: #faba3e;
        border-color: #f4a306;
        background-image: -webkit-linear-gradient(top, #fcd589, #faba3e);
        background-image: -moz-linear-gradient(top, #fcd589, #faba3e);
        background-image: -o-linear-gradient(top, #fcd589, #faba3e);
        background-image: linear-gradient(to bottom, #fcd589, #faba3e);
        text-decoration: none;
    }
    .add-btn:hover{
        color: #FFF;
        text-decoration: none;
    }
    .add-btn:visited{
        color: #FFF;
        text-decoration: none;
    }
    .add-btn:active{
        color: #FFF;
        text-decoration: none;
    }
    textarea{
        width:97%;
        height:200px;
        padding-top: 10px;
        margin-top:10px;
    }
    #error{
        color:#f00;
    }

</style>
<script>
    $(document).ready(function() {
        $("#button").click(function() {
            $("#addAnswer").toggle("blind", {}, 500);
        });

        $("#submitAnswer").click(function() {
            $("#addAnswer").hide("blind", {}, 500);
        });
    });
</script>
<section id="content">
    <article>
        <header class="question"><a href="#"><?= $this->question[0]["subject"] ?></a></header>
        <p class = "navigation">
            <span class="username-icon" ></span><a href="/user/profile/<?= $this->question[0]["creator"][0]["user_id"] ?>"><?= $this->question[0]["creator"][0]["username"] ?></a>
            <span class="added-time-icon" ></span><a href="#"><?= @$this->question[0]["create_date"] ?></a>
            <span class="tags-icon" ></span>
            <span class="tags-display">
                <?php
                for ($j = 0; $j < count($this->question[0]["tags"]); $j++) {
                    echo "<a href=\"/questions/tag/" . $this->question[0]["tags"][$j]['tag_id'] . "\">" . $this->question[0]["tags"][$j]["tag_name"] . "&nbsp;</a>";
                }
                ?>
            </span>
        </p>
        <div id="profile-left">
            <img src="<?= @$this->avatarPath.$this->question[0]["creator"][0]["avatar"] ?>" width="100px" height="100px">
            <div class="counters" id="scoring-<?= @$this->allQuestions[$i]["question_id"] ?>">
                <div>
                    <span value="+" class="glyphicon glyphicon-chevron-up"></span>
                    <span><?= $this->question[0]["score"] ?></span> 
                </div>
                <div>
                    <span type="submit" value="-" class="glyphicon glyphicon-chevron-down">
                    </span><span>Votes</span>
                </div>
            </div>
        </div>
        <div id="profile-right">
            <p class="post-body"><?= $this->question[0]["body"] ?></p>
        </div>
        <a href="#" id="button" class = "add-btn">Add answer</a>
    </article>

    <article style="display:<?php echo @$this->expanded; ?>;" id="addAnswer">
        <form action="/answer/add" method="post">
            <br/>
            <label for="answerBody">Your answer:</label>
            <textarea name="answerBody" id="answerBody"></textarea><br />        
            <div id="error"><?= @$this->response ?></div>
            <input type="hidden" name="questionId" value="<?= $this->question[0]["question_id"] ?>" />
            <input class ="add-btn" type="submit" id="submitAnswer" value="Add">
        </form>

    </article>

    <?php
    for ($i = 0; $i < count($this->answers); $i++) {
        ?>
        <article>
            <p class = "navigation">
                <span class="username-icon" ></span><a href="/user/profile/<?= @$this->answers[$i]["creator"][0]["user_id"] ?>"> <?= @$this->answers[$i]["creator"][0]["username"] ?></a>
                <span class="added-time-icon" ></span><a href="#"><?= @$this->answers[$i]["create_date"]  ?></a>
            </p>
            <div id="profile-left">
                <img src="<?= @$this->avatarPath.$this->answers[$i]["creator"][0]["avatar"] ?>" width="100px" height="100px">
                <div class="counters" id="scoring-<?= @$this->allQuestions[$i]["question_id"] ?>">
                    <div>
                        <span value="+" class="glyphicon glyphicon-chevron-up"></span>
                        <span><?= @$this->answers[$i]["creator"][0]["score"] ?></span> 
                    </div>
                    <div>
                        <span type="submit" value="-" class="glyphicon glyphicon-chevron-down">
                        </span><span>Votes</span>
                    </div>
                </div>
            </div>
            <div id="profile-right">
                <p class="post-body"><?= @$this->answers[$i]["answer_body"] ?></p>
            </div>
            <a href="#" id="button" class = "add-btn">Add answer</a>
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