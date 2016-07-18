# ProcessWire Module "Data Providers" #

This module offers you a new abstraction layer to separate

With installing this module you may provide a custom DataProvider class for each of your ProcessWire output templates.
These class must extend **ffe\ProcessWire3\DataProviders\PageDataProvider** and must be called like a pascal-cased version
of the template's name with a 'PageDataProvider' suffix.

Some examples:  
  
Template name --> PageDataProvider class name  

- home --> My\Configured\BaseNamespace\HomePageDataProvider  
- news_list --> My\Configured\BaseNamespace\NewsListPageDataProvider  
- customer-details --> My\Configured\BaseNamespace\CustomerDetailsPageDataProvider 

The PageDataProvider class provides a public **populate()** for you to provide custom data for your templates to output.

    public function populate()
    {
        parent::populate();
        $this->wire('foo', 'bar');  // provides the fuel variable $foo to use within the page's template
        $this->page->foo = 'baz';   // provides page member $page->foo to use within the page's template
    }

## Installing the module ##

Just copy the module files into you `site/modules/` folder or download it via the ModuleManager.  
Your directory structure should look like this:  

site/  
|-> modules/  
|--|-> DataProviders  
|--|--|-> src  
|--|--|--|-> ffe  
|--|--|--|--|-> DataProviders  
|--|--|--|--|--|-> AbstractDataProviders.php  
|--|--|--|--|--|-> DataProvidersFactory.php  
|--|--|--|--|--|-> DataProvidersFactoryException.php  
|--|--|--|--|--|-> PageDataProvider.php  
|--|--|--|--|-> Psr4Autoloader.php  
|--|--|--|-> DataProviders.module  
|--|--|--|-> DataProvidersConfig.php  
|--|--|--|-> LICENSE.txt  
|--|--|--|-> README.md  
 
After deploying the module files go to **Setup/Modules** in your ProcessWire backend. You should find the
**Data Providers** module in the **Data** section. Hit install and be ready.
 
## Configuring the module ##

The **Data Providers** module offers a small set of configuration options. Follow the hints and notes given within the 
configuration form.

## Dependancies ##

### ProcessWire Versions ###

This module is built for ProcessWire 3 only, requiring version 3.0.25 with support for file compilers at minimum.

## Adding fuel to all templates ##

Sometimes you need to add some view data to all your templates. To archive this you may define an abstract base class 
for all your concrete PageDataProvider classes to inherit from. This base class must extend PageDataProvider and 
should override the populate() method.

    namespace My\Site\DataProviders;
    
    use ffe\ProcessWire3\DataProviders\PageDataProvider;
    
    /**
     * Class MyBasePageDataProvider
     */
    abstract class MyBasePageDataProvider extends PageDataProvider
    {
        /**
         * Add data for all your PageDataProvider classes here
         */
        public function populate()
        {
            parent::populate();
            
            // add global template fuel here
            $this->page->myProperty = 'This is accessible from all templates having a PageDataProvider';            
            $this->wire('my_fuel', 'This is accessible from all templates having a PageDataProvider'); 
        }
    }
    
Be sure to call `parent::populate()` from within the populate() implements of all your concrete PageDataProviders first!

## Customizing DataProviders Class Loading##

You may customize the process of loading the appropriate DataProvider class for a specific page. The **DataProviders** 
module provides two hooks you may use to tap into.
 
### DataProvidersFactory::getPageDataProvider(Page $page)
 
This hook is called whenever a page is rendered by ProcessWire.  
The built-in behaviour is to call DataProvidersFactory::getPageDataProviderClass($page) to retrieve the appropriate 
PageDataProviders class name and return an instance of this class if it exists.
  
### DataProvidersFactory::getPageDataProviderClass(Page $page) 
 
This hook is called whenever DataProvidersFactory::getPageDataProvider() is called.
The built-in behaviour is to return a pascal-cased version of the page's template name with the configured base
namespace for DataProvider classes as prefix and a 'PageDataProviders' suffix.

## Todos ##

- Implement the Page::renderChunk hook (see [Issue #1925](https://github.com/ryancramerdesign/ProcessWire/issues/1925))

## Known issues ##

None so far.

## License

This module is released under the MIT License.
See [LICENSE.txt](https://github.com/marcostoll/processwire3-data-providers/blob/master/DataProviders/LICENSE.txt). 