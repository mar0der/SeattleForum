<aside id="categories">
    <h4>Categories</h4>
    <ul>
        <li>category name 1<span>01</span></li>
        <li>category name 2<span>02</span></li>
        <li>category name 3<span>03</span></li>
        <li>category name 4<span>04</span></li>
        <li>category name 5<span>05</span></li>
        <li>category name 6<span>06</span></li>
        <li>category name 7<span>07</span></li>
        <li>category name 8<span>08</span></li>
        <li>category name 9<span>09</span></li>
        <li>category name 10<span>10</span></li>
        <li>category name 11<span>11</span></li>
        <li>category name 12<span>12</span></li>
        <li>category name 13<span>13</span></li>
        <li>category name 14<span>14</span></li>
        <li>category name 15<span>15</span></li>
    </ul>
</aside>
<aside id="tags">
    <h4>Tags</h4>
    <a href="">tag01</a>
    <a href="">tag02</a>
    <a href="">tag03</a>
    <a href="">tag04</a>
    <a href="">tag05</a>
    <a href="">tag06</a>
    <a href="">tag07</a>
    <a href="">tag08</a>
    <a href="">tag09</a>
    <a href="">tag10</a>
    <a href="">tag11</a>
    <a href="">tag12</a>
    <a href="">tag13</a>
    <a href="">tag14</a>
    <a href="">tag15</a>
    <a href="">tag16</a>
    <a href="">tag17</a>
    <a href="">tag18</a>
    <a href="">tag19</a>
    <a href="">tag20</a>
    <a href="">tag21</a>
    <a href="">tag22</a>
    <a href="">tag23</a>
    <a href="">tag24</a>
    <a href="">tag25</a>
</aside>
<section>
    <?php
    v($this->d);
    ?>
    <form method="post" action="index.php?url=user/edit" enctype="multipart/form-data">
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
            <input type="file" id="picture"name="pic"><br />
            <span class="error"><?php echo @$this->e['uploaded-file']; ?></span><br />
            <input type="hidden" name="userid" value="<?php echo @$this->dataUser[0]['userid']; ?>">
            <input type="submit" value="Save Profile">
            <fieldset>
                </form>
                <article>

                    </section>
