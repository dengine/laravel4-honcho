# Honcho User Admin Package


** STILL IN DEVELOPMENT **

Honcho is a package created specifically for Laravel 4, built around Sentry 2 for managing your users,
groups and permissions.

## Before You Start
Here are just a few caveats before we get going...

### What Honcho is Not
Honcho does not try to do everything. It's really just a jumping base or even an example. It works fine,
but it is not a shoe that is meant to fit every foot. I'm personally not a fan of catch-all type applications.

### Prerequisites
You must have Sentry installed and ready to go. Run your migrations, take a gander through the config and
familiarize yourself with Sentry.


## Installation
Okay, so you ready to start cooking?  Let's dig in...

**IMPORTANT**
Honcho required that you have Cartalyst\Sentry and Dberry37388\Messages installed. Please see those
packages for installation instructions. Those are included in the Honcho composer.json, and if they
are not already installed by composer, they will install when you add Honcho. You will still need
to follow the instructions to finish adding these packages.

- For Sentry, please see: http://docs.cartalyst.com/sentry-2/installation/laravel-4
- For Messages, please see: https://github.com/dberry37388/laravel4-messages

### Adding Honcho to Your Composer
Open your composer.json file and add the following line

 ```
"dberry37388/honcho": "dev-master"
 ```

### Adding the Service Provider
In your laravel install, open app/config/app.php and add the following to the service providers array

```
'Dberry37388\Honcho\HonchoServiceProvider', // this is honcho
```

### Run Migrations
Note, Sentry should be installed & migrated before running this.

Open up artisan and run

```
php artisan migrate --package=dberry37388/honcho
```

### Publish the Config Files
You'll more than likely want to make some changes to Honcho. Most everything is configurable. Running
this command will put the configuration for these packages in your app/config/packages folder so that
you can make changes to them without having to worry about them being overwritten during updates.

So open up your command line and run

```
php artisan config::publish dberry37388/honcho
```

### Publish Honcho Assets
Honcho comes with a basic set of views. More than likely you will want to customize these, but to get
it up and running quickly and to check it out, let's publish our assets so they are available. All
views can be configured using the config files in app/config/packages/dberry37388/honcho.

If you are not going to use Honcho's views, you can skip this step.

Open up your command line and run the following command.  This will load Honcho's default assets.

```
php artisan asset:publish dberry37388/honcho
```

## Getting to Know Honcho
Spend some time looking through the code, to see if you can follow my madness. Feel free to ask questions.
Also take a look through Sentry's docs and code so that you can better understand what is going on.

## Some Notes of Interest
- The models used are configurable. Just open up the sentry config to change the user, group & throttle models
- FormModels are also configurable, those are located in the respective Honcho config
- All views are configurable, so you can put these where you want.
- The configs are pretty consistent. I've broken them down into Controller -> Action, so they should be easy to navigate.

## Customizing Honcho
Spend time looking through the config files, there is a lot that you are able to customize in Honcho, from views,
to controllers to models.

**Make sure you run the ```php artisan config:publish --package=dberry37388/honcho``` before making changes to the config.**
If you do not publish the config, your changes will be overridden on the next composer update.

### Form Models
We are using a variation of the FormModel class by Shawn McCool to manage our form fields and validation. Obviously fields
are something that could vary from application to application. So if you need to stray from the defaults, then open up the
respective config file and look for the ```models => array()``` for that controller.  You can put the model anywhere you
like. Use the existing form models as a template guide.

Please make sure you read the comments inside the FormModels as they will provide insight into what is going on.

### Controllers
Like form models, controllers are something that you may want to stray a little from Honcho defaults on.
Just open the respective config file, for example, users is config/user, and look for the ```'controller' => ''``` field.
If for some reason you've changed the controller var and wish to go back to the Honcho default, set your controller var to
look like this:

```
'controller',
```

### Views
Views are also configurable by the respective config files. For each action in the controller, there is a corresponding
configuration array. Change the ```'view' => ''``` to match the location of your view.