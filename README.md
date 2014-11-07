SalesforceBundle
===================

[![Latest Stable Version](https://poser.pugx.org/elcweb/salesforce-bundle/v/stable.png)](https://packagist.org/packages/elcweb/salesforce-bundle)
[![Total Downloads](https://poser.pugx.org/elcweb/salesforce-bundle/downloads.png)](https://packagist.org/packages/elcweb/salesforce-bundle)

Installation
------------

### Step 1: Download using composer

``` js
{
    "require": {
        "elcweb/salesforce-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update elcweb/salesforce-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Elcweb\SalesforceBundle\ElcwebSalesforceBundle(),
    );
}
```

Configuration reference
-----------------------
```
elcweb_salesforce:
    wsdl:     %salesforce_soap_wsdl%
    username: %salesforce_soap_username%
    password: %salesforce_soap_password%
    token:    %salesforce_soap_token%
    ttl:      14400 # ttl in secondes
```

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/elcweb/salesforce-bundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.
