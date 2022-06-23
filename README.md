# User Agent Parser Bundle for Symfony

> ABANDONED - Please use [whichbrowser](https://whichbrowser.net) instead.
> 
> A small bundle for returning a visitor's used browser and operating system from the UserAgent.

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require shadesoft/user-agent-parser-bundle "dev-master"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new ShadeSoft\UserAgentParserBundle\ShadeSoftUserAgentParserBundle(),
        );

        // ...
    }

    // ...
}
```

## Usage:

```php
<?php
// src/Acme/DemoController.php

// ...
class DemoController extends Controller
{
    public function DemoAction(Request $request) {
        // ...
        
        $uaParser = $this->get('shadesoft_user_agent_parser.parser');
        $ua = $request->headers->get('User-Agent');
        
        $browser = $uaParser->getBrowser($ua);
        $browserName    = $browser['name'];
        $browserVersion = $browser['version'];
        
        $os = $uaParser->getOS($ua);
        $osName     = $os['name'];
        $osVersion  = $os['version'];
        
        // ...
    }
    
    // ...
}
```
