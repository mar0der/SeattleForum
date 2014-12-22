<style scoped>
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
    <form method="post" action="/user/register" enctype="multipart/form-data">
        <fieldset>
            <legend>User information</legend>
            <label for="username">Username</label>    			
            <input type="text" id="username" placeholder="Username" name="username" value="<?php echo @$this->d["username"]; ?>" />
            <span class="error"><?php @$this->e; ?></span><br />

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="pass" value="<?php echo @$this->d['password']; ?>">
            <span class="error"> <?php echo @$this->e['pass-error']; ?> </span><br />

            <label for="conf-password">Confirm Password</label>
            <input type="password" id="conf-password" placeholder="Confirm Password" name="confirm-pass">
            <span class="error"> <?php echo @$this->e['pass-error']; ?> </span><br />

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" name="email" value="<?php echo @$this->d['email']; ?>">
            <span class="error"> <?php echo @$this->e['email']; ?> </span><br />

            <label for="first-name">First name</label>
            <input type="text" id="first-name" placeholder="First name" name="first-name" value="<?php echo @$this->d['first_name']; ?>">
            <span class="error"> <?php echo @$this->e['first-name']; ?> </span><br />	

            <label for="male">Male</label>
            <input type="radio" id="male" name="gender" value="0"><br />

            <label for="female">Female</label>
            <input type="radio" id="female" name="gender" value="1"><br />

            <label for="other">Unknown</label>
            <input type="radio" id="other" checked="checked" name="gender" value="2"><br />

            <label for="pic">Picture</label>
            <input type="file" id="pic" name="pic">
            <span class="error"> <?php echo @$this->e['uploaded-file']; ?> </span><br />

            <input type="submit" value="Register" />
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