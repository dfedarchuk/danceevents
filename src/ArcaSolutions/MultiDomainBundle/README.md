# Arca MultiDomainBundle

The MultiDomainBundle provides multi-domain capabilities to Symfony.

## Requirements

* Symfony ~2.3
* See also the `require` section of [composer.json](composer.json)

## Installation

### Get the bundle

Add the following lines in your composer.json:

```
{
    "repositories": [
        {
            "type": "package",
            "package": {
                "name": "arcasolutions/multidomainbundle",
                "version": "0.1.0",
                "source": {
                    "url": "https://netuno.arcasolutions.com/diego.mosela/MultiDomainBundle.git",
                    "type": "git",
                    "reference": "master"
                },
                "autoload": {
                    "psr-4": { "ArcaSolutions\\MultiDomainBundle\\": "" }
                }
            }
        }
    ],
    
    "require": {
        // ...
        "arcasolutions/multidomainbundle": "0.1.0",
    }
}
```

### Initialize the bundle

To start using the bundle, register the bundle in your application's kernel class:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new ArcaSolutions\MultiDomainBundle\MultiDomainBundle(),
    );
)
```

### Configuration

``` yaml
# app/config/config.yml
multi_domain:
    hosts:
        domain1.com:
            id: 1
            path: domain1/
            template: default
            locale: en
            database: domain1
        domain1.com.br:
            id: 2
            path: domain2/
            template: default
            locale: pt-br
            database: database2
