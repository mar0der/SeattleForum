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
    #profile-left{
        width: 30%;
        display: inline-block;
    }
    #profile-right{
        width: 65%;
        display:inline-block;
    }
    ul{
        list-style: none;
    }
   
</style>
<section id="questions">
    <article>
        <div id="profile-left">
            <ul>
                <li><h1><?= @$this->d[0]['first_name']; ?></h1></li>
                <li><h3>(<?= @$this->d[0]['username']; ?>)</h3></h1>
                <li><img src="<?= @$this->d[0]['avatar']; ?>" width="150px" height="150px"></li>
            </ul>
        </div>
        <div id="profile-right">
            <ul id = "user-data">
                <li><h1>User Information</h1></li>
                <li><h4>Registered On: <?= @$this->d[0]['registered_on']; ?></h4></h1>
                <li><h4>Score: <?= @$this->d[0]['score']; ?><h4></li>
                <li><h4>Role: <?= @$this->d[0]['role']; ?><h4></li>
                <li><h4>Last Login: <?= @$this->d[0]['last_login']; ?><h4></li>
            </ul>
        </div>
    </article>
</section>
<aside id="categories">
    <h4>Categories</h4>
    <ul>
        <?php for ($i = 0; $i < count($this->allCategories); $i++) { ?>
            <li><?= @$this->allCategories[$i]["category_name"] ?><span><?= $this->allCategories[$i]["questions_number"] ?></span></li>
            <?php
        }
        ?>
    </ul>
</aside>
<aside id="tags">
    <h4>Tags</h4>
    <?php for ($i = 0; $i < count($this->allTags); $i++) { ?>
        <a href=""><?= @$this->allTags[$i]["tag_name"] ?></a>
        <?php
    }
    ?>
</aside>
