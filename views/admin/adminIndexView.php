<h1>User: Create</h1>

<form method="post" action="admin/create">
    <label>Login</label><input type="text" name="username" /><br />
    <label>Password</label><input type="text" name="password" /><br />
    <label>Role</label>
    <select name="role">
        <?php //@TODO: get this info autocamticly ?>            
        <option value="guest">Guest</option>
        <option value="user">User</option>
        <option value="owner">Owner</option>
    </select><br />
    <label>&nbsp;</label><input type="submit" value="Add User" />
</form>
<hr />
<table>
    <?php
    foreach ($this->userList as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value['userid'] . "</td>";
        echo "<td>" . $value['username'] . "</td>";
        echo "<td>" . $value['role'] . "</td>";
        echo "<td>";
        echo "<a href=\"admin/edit/" . $value['userid'] . "\">Edit</a> | ";
        echo "<a href=\"admin/delete/" . $value['userid'] . "\">Delete</a>";
        echo "</td>";
        echo '</tr>';
    }
    ?>
</table>