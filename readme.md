Honcho User Admin Package
=========================

** STILL IN DEVELOPMENT **

Honcho is a package created specifically for Laravel 4, built around Sentry 2 for managing your users,
groups and permissions.

Installation
-------------

Honcho required that you have Cartalyst\Sentry and Dberry37388\Messages installed. Below contains the
information for installing all of these together. Just ignore the items that you may already have
installed on your own.

###Open your composer.json file and add the following line

 ```
 "cartalyst/sentry": "2.0.*",
 "dberry37388/messages": "dev-master"
 "dberry37388/honcho": "dev-master"

 ```

###In your laravel install, open app/config/app.php and add the following

```
// in the service providers section add

'Cartalyst\Sentry\SentryServiceProvider',
'Dberry37388\Honcho\HonchoServiceProvider', // this is honcho
'Dberry37388\Messages\MessagesServiceProvider' // honcho uses this for displaying messages (alerts)

// in the facades section add

'Sentry'   => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
'Messages' => 'Dberry37388\Messages\Facades\Laravel\Messages',
'Settings' => 'Dberry37388\Honcho\Facades\SettingsFacade'

###Publish the Packages Configuration Files so that you can update them as needed.
Open up your command line so that we can run the following commands. These will put the configuration
for these packages in your app/config/packages folder so that you can make changes to them without
having to worry about them being overwritten during updates.

####Sentry Config:
``` php artisan config:publish cartalyst/sentry ```

####Honcho Config
``` php artisan config::publish dberry37388/honcho ```

###Publish Honcho Assets
Open up your command line and run the following command.  This will load Honcho's default assets.
If you are not going to use Honcho's views, you can skip this step.

All views can be configured using the config files in app/config/packages/dberry37388/honcho.

``` php artisan asset:publish dberry37388/honcho ```

### Configuring Sentry
Please visit the Sentry documentation for more information on getting Sentry 2 up and running.

###Configuring Honcho
I've tried to make Honcho as configurable as possible, without making it too generic.  Look through
the configuration files to see what is available to you.

**This will contain more information later**