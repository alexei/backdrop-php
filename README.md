Backdrop
========

Backdrop is a configuration system that keeps your settings out of source control.

It's curently JSON based. Other formats may be available in the future.

This is the PHP version. Theres also a [Python version](https://github.com/alexei/backdrop).

Use
---
Configuration files must be stored in a directory named `.backdrop` located either in the user's home directory or in the current working directory.

For example, create a new project configuration file:

    touch ~/.backdrop/myproject.json

Open it with your favorite editor:

    vim ~/.backdrop/myproject.json

Save your settings, e.g.:

    {
        "database": {
            "username": "myproject",
            "password": "53cr3tp455w0rd"
        }
    }

In your project, include `backdrop` and load the configuration:

    <?php

    require_once 'Backdrop.php';

    $config = new Backdrop('myproject');

Windows
---
On Windows there's currently no support for configuration files located in the user's home directory.
