<?php
if (isset($_REQUEST['error'])){
    $error = $_REQUEST['error'];

    if ($error == 'exists'){
        echo 'User already exists!';
    }
}

?>
<form action="backend/registration_handler.php" method="POST">
    <table>
        <tr>
            <th>Username*:</th> <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <th>Password*:</th><td><input type="text" name="password"></td>
        </tr>
        <tr>
            <th>first_name:</th> <td><input type="text" name="fname"></td>
        </tr>
        <tr>
            <th>last_name:</th> <td><input type="text" name="lname"></td>
        </tr>
        <tr>
            <td><input type="submit" value="register!"></td>
        </tr>

    </table>
</form>
