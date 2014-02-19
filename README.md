# Infusionsoft PHP SDK

[Novak Solutions](http://novaksolutions.com/?utm_source=github&utm_medium=readme&utm_campaign=homepage) created the *Infusionsoft PHP SDK* to make it easier to develop for the Infusionsoft platform. The SDK utilizes the official Infusionsoft API, but works around some of its [known gotchas](http://novaksolutions.com/infusionsoft-api-gotchas/?utm_source=github&utm_medium=readme&utm_campaign=gotchas).

## Why use the Infusionsoft PHP SDK?

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

## Usage

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