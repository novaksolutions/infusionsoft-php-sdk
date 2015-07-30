# Novak Solutions - Infusionsoft PHP SDK

[Novak Solutions](https://novaksolutions.com/?utm_source=github&utm_medium=readme&utm_campaign=homepage) created the *Infusionsoft PHP SDK* to make it easier to develop for the Infusionsoft platform. The SDK utilizes the official Infusionsoft API, but works around some of its [known gotchas](https://novaksolutions.com/infusionsoft-api-gotchas/?utm_source=github&utm_medium=readme&utm_campaign=gotchas).  **This IS NOT the official sdk.**

## Why use the our SDK instead of the official one?

- **No dependencies.** If your server has PHP and cURL, then you are good to go!
- **Code completion.** We've added all the necessary PHPDoc comments so code completion will work in popular editors, like Eclipse and PhpStorm.
- **Automatically retries.** Automatically retries failed API calls when it is safe to do so (i.e., updates and deletes).
- **Automatically handles XML-RPC.** Your requests and responses are automatically encoded and decoded.
- **Automatically picks the right method.** Saving records is easier. The SDK will automatically pick whether to do an insert or an update based on whether you are working with a new or existing record.
- **Future safe!** The SDK will keep working, even if Infusionsoft removes a field in the future.

## Fully Supported

The *Infusionsoft PHP SDK* is fully supported. If you find a bug or are having problems, [submit an issue](https://github.com/novaksolutions/infusionsoft-php-sdk/issues) and we'll fix it.

We also appreciate community contributions. To contribute: fork the SDK repo, make your changes, and submit a pull request.

## Installation

We keep the `master` branch production ready. To install, simply clone the SDK into a convenient folder. For example:

```sh
git clone git@github.com:novaksolutions/infusionsoft-php-sdk.git
```

You'll also need to copy `Infusionsoft/config.sample.php` to `Infusionsoft/config.php`. Edit this file and add your app name and [API key](http://ug.infusionsoft.com/article/AA-00442).

##OAuth2 Usage

The following example code shows how to authenticate using OAuth2.  This will automatically save your access and refresh tokens to the current directory in a file called infusionsoft-tokens.php.  We store it in a php file that is empty except for a comment so that no one can access this file on your server unless you aren't running php.

```php
//This makes troubleshooting MUCH easier.
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Load Infusionsoft
require 'Infusionsoft/infusionsoft.php';

//Load config file (copy config.sample.php to config.php and put your clientid (key) and secret in.
require 'config.php';

//Sets the redirect url to the current url
Infusionsoft_OAuth2::$redirectUri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//When this is called, it will process the authentication response, convert the OAuth2 GET params to your access and refresh tokens.  And then save them.
Infusionsoft_OAuth2::processAuthenticationResponseIfPresent();

//If you don't specify a hostname, connect() will load the hostname automatically from the saved file.  Note, this library does support multiple apps, so, if you authenticate to more then one app, you really should specify the app to connect to.
$app = Infusionsoft_App::connect();

//If We Just Got Back From The OAuth Page...
if(!$app->hasTokens()){
    header("Location: " . Infusionsoft_OAuth2::getAuthorizationUrl());//Send To OAuth Page...
    die();
}

$results = Infusionsoft_DataService::query(new Infusionsoft_Contact(), array('FirstName' => '%'), 2);

?>
<pre><?php var_dump($results); ?></pre>
```

## Legacy API Key Usage

To help you get started, we've created a screencast that will walk you through using the SDK to create a contact in your Infusionsoft app. You can find the video on YouTube: [Using the Novak Solutions SDK with the Infusionsoft API](http://youtu.be/I4NvbIKrE1E).

You can also find a bunch of real-world code samples in our GitHub wiki on the [Examples](https://github.com/novaksolutions/infusionsoft-php-sdk/wiki/Examples) page.

Your project will need to include `Infusionsoft/infusionsoft.php`, a bootstrapper that automatically loads any classes that are needed. For example:

```php
<?php

require_once('Infusionsoft/infusionsoft.php');
```

See `example.php` for a very basic usage example. Additional examples can be found in the `Infusionsoft/examples/` folder.

## WordPress

If you'd like to use the SDK inside of WordPress or with a WordPress plugin, please use the [Infusionsoft SDK](https://github.com/novaksolutions/infusionsoft-sdk-for-wordpress) plugin. It is listed in the [WordPress.org plugin directory](http://wordpress.org/plugins/infusionsoft-sdk/) so you can easily install it to any WordPress blog. We regularly update this plugin whenever the SDK is updated so you'll always get the latest bug fixes and new features.

Using the Infusionsoft SDK plugin will allow your plugin or custom code to work alongside other plugins that use the *Infusionsoft PHP SDK*.

## License

The *Infusionsoft PHP SDK* is licensed under the MIT License. It is simple and easy to understand and it places almost no restrictions on what you can do with the SDK.

You are free to use the *Infusionsoft PHP SDK* in any other project (even commercial projects) as long as the copyright header is left intact.

Details of this license are included in the MIT-LICENSE.txt file, and must be included in all copies of the SDK.
