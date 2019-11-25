<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
$obj = DB::getInstance();

foreach ($obj->getAll("users") as $value) {
    echo $value['username'] . "<br />";
}

if ($user->isLoggedIn()) {
?>
    <p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>

    <ul>
        <li><a href="logout.php">Log out!</a></li>
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Change password</a></li>
    </ul>
<?php

if ($user->hasPermission('admin')) {
    echo 'You are as an Admin';
}

} else {
    echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>.';
}