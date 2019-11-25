<?php
    require_once 'core/init.php';

    $user = new User();

    if (!$user->isLoggedIn()) {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'username' => array('required' => true),
                    'password' => array('required' => true)
                ));

                if ($validation->passed()) {
                    // log user in
                    $user = new User();

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                    if ($login) {
                        Redirect::to('index.php');
                    } else {
                        echo 'Sorry, logging in failed';
                    }
                } else {
                    foreach ($validation->errors() as $error) {
                        echo $error . '<br />';
                    }
                }

            }
        }
    } else {
        Redirect::to('index.php');
    }
?>

<form action="" method="post">

    <div class="fields">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="" autocomplete="off">
    </div>

    <div class="fields">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
    </div>

    <div class="fields">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">Remember Me
        </label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Login">

</form>