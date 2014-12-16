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

<?php
for($i = 0; $i < count($this->allQuestions); $i++) {
?>
    <article>
        <header><a href="#"></a><?=$this->allQuestions[$i]["subject"]?></header>
        <p>
            <span><?=$this->allQuestions[$i]["avatar"]?></span>
            <a href="#"><?=$this->allQuestions[$i]["username"]?></a>
            <span><?=$this->allQuestions[$i]["create_date"]?></span>
            <span><?=$this->allQuestions[$i]["score"]?></span>
            <span><?=$this->allQuestions[$i]["visites"]?></span>
            <span><?=$this->allQuestions[$i]["answers_number"]?></span>
            <span>Posleden otgowor: <?=$this->allQuestions[$i]["latest_answer"]["username"]?></span>
            <span> <?=$this->allQuestions[$i]["latest_answer"]["create_date"]?></span>
            <?php /*
            for($j = 0; $j < count($this->allTags); $j++) {
                ?>
<!--?????                <span>tagImg</span>  -->
                <a href=""><?=$this->allTags["tag_name"]?></a>
            <?php
            }*/ //I don't know about this one... it shouldn't be allTags
            ?>
        </p>
        <div><?php //$this->allQuestions[$i]["body"]?></div>
    </article>

    <?php } ?>
<!--    <article>
        <header><a href="#"></a>question subject 1</header>
        <p>
            <span>usrImg</span>
            <a href="#">user</a>
            <span>01/12/2014</span>
            <span>tagImg</span>
            <a href="">tag1</a>
        </p>
        <div>bottom part of the article do it yourself</div>
    </article>
-->
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