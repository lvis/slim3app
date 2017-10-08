# slim3app
A Slim 3 application was built for Composer and makes setting up a new application quick and easy.
This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

## Install the Application
Run this command from the directory in which you want to install your new application.

    php composer.phar create-project lvis/slim3app [app-name]

* Replace <code>[app-name]</code> with the desired directory name for your new application.
* Ensure `logs/` and `templates/cache` are web writeable.

You can run application in development with this command:

    php -S localhost:8080 index.php
    
or composer one:

    php composer.phar start
    
Run this command to run the test suite

	php composer.phar test

