<style>
    article{
        background-color:white;
        border-radius: 10px;
        border: 1px solid #436fac;
        padding:10px;
        margin-bottom:10px;
    }
    #profile-left{
        width: 25%;
        display: inline-block;
    }
    #profile-right{
        width: 70%;
        display:inline-block;
        vertical-align: top;

        padding-left: 5px;
        border-left: 1px solid gray;
    }
    /**** profile part */
    header.user-profile-header{
        font-size: 22px;
        font-weight: bolder;
    }

    span.user-data{
        font-weight: normal;
        font-size: 16px;
    }
    span.user-data-header{
        font-weight: bold;
        font-size: 14px;
    }
    .username{
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 2px;
    }
    .role{
        color:#fff;
        font-size: 14px;
        padding: 1px 5px;
        background-color: green;
        border-radius: 2px;
        display: inline-block;
    }
    .edit-btn{
        color:#fff;
        font-size: 14px;
        padding: 1px 5px;
        background-color: #436fac;
        border-radius: 2px;
        display: inline-block;
        text-decoration: none;
    }
    .delete-btn{
        color:#fff;
        font-size: 14px;
        padding: 1px 5px;
        background-color: red;
        border-radius: 2px;
        display: inline-block;
        text-decoration: none;
    }

</style>
<section id="questions">
    <article>
        <div id="profile-left">
            <img src="<?= @$this->d[0]['avatar']; ?>" width="150px" height="150px">
            <div class="username" ><?= @$this->d[0]['first_name'] . " (" . @$this->d[0]['username']; ?>)</div>
            <div class="role" ><?= @$this->d[0]['role']; ?></div>
            <a href="/user/edit/1" class = "edit-btn">edit</a>
            <a href="/user/edit/1" class = "delete-btn">delete</a>
        </div>
        <div id="profile-right">
            <header class="user-profile-header">User Information</header>
            <span class="user-data-header">Registered On:</span> <span class="user-data"><?= @$this->d[0]['registered_on']; ?></span><br />
            <span class="user-data-header">Score: </span><span class="user-data"><?= @$this->d[0]['score']; ?></span><br />
            <span class="user-data-header">Gender: </span><span class="user-data"><?= @$this->d[0]['gender']; ?></span><br />
            <span class="user-data-header">Last seen: </span><span class="user-data"><?= @$this->d[0]['last_login']; ?></span><br />
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
        <a href="/questions/tag/"><?= @$this->allTags[$i]["tag_name"] ?></a>
        <?php
    }
    ?>
</aside>
