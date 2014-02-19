# Infusionsoft PHP SDK

[Novak Solutions](http://novaksolutions.com/?utm_source=github&utm_medium=readme&utm_campaign=homepage) created the *Infusionsoft PHP SDK* to make it easier to develop for the Infusionsoft platform. The SDK utilizes the official Infusionsoft API, but works around some of its [known gotchas](http://novaksolutions.com/infusionsoft-api-gotchas/?utm_source=github&utm_medium=readme&utm_campaign=gotchas).

## Why use the Infusionsoft PHP SDK?

 - **No dependencies.** If your server has PHP and cURL, then you are good to go!
 - **Code completion.** We've added all the necessary PHPDoc comments so code completion will work in popular editors, like Eclipse and PhpStorm.
 - **Automatically retries.** Automatically retries failed API calls when it is safe to do so (i.e., updates and deletes).
 - **Automatically handles XML-RPC.** Your requests and responses are automatically encoded and decoded.
 - **Automatically picks the right method.** Saving records is easier. The SDK will automatically pick whether to do an insert or an update based on whether you are working with a new or existing record.
 - **Future safe!** The SDK will keep working, even if Infusionsoft removes a field in the future.

## Installation

We keep the `master` branch production ready. To install, simply clone the SDK into a convenient folder. For example:

```sh
git clone git@github.com:novaksolutions/infusionsoft-php-sdk.git
```

You'll also need to copy `Infusionsoft/config.sample.php` to `Infusionsoft/config.php`. Edit this file and add your app name and API key.

## Usage

To help you get started, we've created a screencast that will walk you through using the SDK to create a contact in your Infusionsoft app. You can find the video on YouTube: [Using the Novak Solutions SDK with the Infusionsoft API](http://youtu.be/I4NvbIKrE1E).

Your project will need to include `Infusionsoft/infusionsoft.php`, a bootstrapper that automatically loads any classes that are needed. For example:

```php
<?php

require_once('Infusionsoft/infusionsoft.php');
```

See `example.php` for a very basic usage example. Additional examples can be found in the `Infusionsoft/examples/` folder.

## Roadmap

At [Novak Solutions](http://novaksolutions.com/?utm_source=github&utm_medium=readme&utm_campaign=homepage) we use this SDK every day. We are continually working to make it faster, better, and easier to use. We'd love your help! To contribute, fork this project, make your changes, and submit a pull request.

Here are a few ideas we have for upcoming features:

 - Improve error messages when the Infusionsoft API doesn't work or return the expected value.
 - Modify our caching layer to use your preferred caching method if available, such as Memcache or CakePHP's caching.
 - Move custom field definitions from DataObjects to the Infusionsoft_App object.
 - Make it easy to create custom fields from within the SDK without the risk of breaking your Infusionsoft app.
 - Improve caching to automatically invalidate a cache that we know is stale. For example, a contact record's cache would be invalidated if we update that contact record.
 - Automatic discovery of custom fields.
 - Ability to retrieve subsets of fields instead of an entire record. This would likely make API calls faster, and would reduce the amount of data your project has to process.
