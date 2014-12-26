<style scoped>
    /**profile style **/
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
        display: inline-block;
        color: #FFF;
        background-color: red;
        font-family: Arial, sans-serif;
        line-height: 16px;
        padding: 0 7px;
        border-radius: 10px;
        text-shadow: 0 1px rgba(0, 0, 0, 0.25);
        border: 1px solid;
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        background: #77cc51;
        border-color: #59ad33;
        background-image: -webkit-linear-gradient(top, #a5dd8c, #77cc51);
        background-image: -moz-linear-gradient(top, #a5dd8c, #77cc51);
        background-image: -o-linear-gradient(top, #a5dd8c, #77cc51);
        background-image: linear-gradient(to bottom, #a5dd8c, #77cc51);
        text-decoration: none;
    }
    .edit-btn{
        color: #FFF;
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
    .delete-btn{
        color: #FFF;
        background-color: red;
        font-family: Arial, sans-serif;
        line-height: 16px;
        padding: 0 7px;
        border-radius: 10px;
        text-shadow: 0 1px rgba(0, 0, 0, 0.25);
        border: 1px solid;
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 1px rgba(0, 0, 0, 0.08);
        background: #fa623f;
        border-color: #fa5a35;
        background-image: -webkit-linear-gradient(top, #fc9f8a, #fa623f);
        background-image: -moz-linear-gradient(top, #fc9f8a, #fa623f);
        background-image: -o-linear-gradient(top, #fc9f8a, #fa623f);
        background-image: linear-gradient(to bottom, #fc9f8a, #fa623f);
        text-decoration: none;

    }


</style>
<section id="content">
    <article>
        <div id="profile-left">
            <img src="<?= @$this->d[0]['avatar']; ?>" width="150" height="150" alt="<?= @$this->d[0]['first_name'] ?>'s avatar">
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
