<h1>User: Edit</h1>

<form method="post" action="/admin/editSave/">
    <input type="hidden" name="userid" value="<?php echo $this->user[0]['userid']; ?>" /><br />
    <label>Login</label>
    <input type="text" name="username" value="<?php echo $this->user[0]['username']; ?>" /><br />
    <label>Password</label>
    <input type="text" name="password" /><br />
    <label>Role</label>
    <select name="role">
        <option value="guest" <?php if($this->user[0]['role'] == 'guest') echo 'selected'; ?>>Guest</option>
        <option value="user" <?php if($this->user[0]['role'] == 'user') echo 'selected'; ?>>User</option>
        <option value="owner" <?php if($this->user[0]['role'] == 'owner') echo 'selected'; ?>>Owner</option>
    </select><br />
    <label>&nbsp;</label>
    <input type="submit" value ="Save" />
</form>