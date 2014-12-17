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
    <form method="post" action="user/edit" enctype="multipart/form-data">
        <fieldset>
            <label for="username">Username</label>
            <input type="text" id="pass"name="username" value ="<?php echo @$this->dataUser[0]['username'] ?>" disabled>
            <span class="error"><?php echo @$this->e['username']; ?></span><br />

            <label for="pass">Password</label>
            <input type="password" id="pass"name="pass">
            <span class="error"><?php echo @$this->e['pass-error']; ?></span><br />

            <label for="confirm-pass">Confirm Password</label>
            <input type="password" id="confirm-pass"name="confirm-pass">
            <span class="error"><?php echo @$this->e['pass-error']; ?></span><br />

            <?php
            if (Session::get("role") == 'owner') {
                ?>
                <label for="role">Role</label>
                <input type="text" id="role"name="role" value="<?php echo @$this->dataUser[0]['role']; ?>"><br />
            <?php } ?>

            <label for="first-name">First name</label>
            <input type="text" id="first-name"name="first-name" value="<?php echo @$this->dataUser[0]['first_name']; ?>">
            <span class="error"><?php echo @$this->e['first-name']; ?></span><br />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo @$this->dataUser[0]['email']; ?>">
            <span class="error"><?php echo @$this->e['email']; ?></span><br />

            <label for="male">Male</label>
            <input type="radio" id="male" name="gender"  <?php
            if ($this->dataUser[0]['gender'] == 'male') {
                echo "checked=\"checked\"";
            }
            ?> value="0"><br />

            <label for="female">Female</label>
            <input type="radio" id="female" name="gender"  <?php
            if ($this->dataUser[0]['gender'] == 'female') {
                echo "checked=\"checked\"";
            }
            ?>value="1"><br />

            <label for="unknown">Unknown</label>
            <input type="radio" id="unknown" name="gender"  <?php
            if ($this->dataUser[0]['gender'] == 'unknown') {
                echo "checked=\"checked\"";
            }
            ?>value="2"><br />

            <label for="picture">Picture</label>
            <input type="file" id="picture" name="pic"><br />
            <span class="error"><?php echo @$this->e['uploaded-file']; ?></span><br />
            <input type="hidden" name="userid" value="<?php echo @$this->dataUser[0]['userid']; ?>">
            <input type="submit" value="Save Profile">
        </fieldset>
    </form>
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
