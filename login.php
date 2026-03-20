<?php
if (isset($_REQUEST['error'])){
    $error = $_REQUEST['error'];

    if ($error == 'wrong_cred'){
        echo 'Wrong credentials!';
    }
}

?>

<form action="login_handle.php" method="POST">
    <table>
        <tr>
            <th>Username:</th> <td><input type="text" name="username" placeholder="Username" required></td>
        </tr>
        <tr>
            <th>Password:</th> <td><input type="text" name="password" placeholder="Password" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="submit!"></td>
        </tr>
    </table>
</form>