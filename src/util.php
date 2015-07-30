<?php

function get_user_homedir() {
    $homedir = '';

    if (function_exists('posix_getpwuid') && function_exists('posix_getuid')) {
        $user_info = posix_getpwuid(posix_getuid());
        $homedir = $user_info['dir'];
    }

    return $homedir;
}
