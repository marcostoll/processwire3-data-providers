<?php

/**
 * Class definition of DataProvidersFactory
 *
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @version 1.0.0
 * @copyright 2016, Marco Stoll, https://github.com/marcostoll
 * @filesource
 */

namespace ffe\ProcessWire3\DataProviders;

use ProcessWire\Page;
use ProcessWire\WireData;

/**
 * Class DataProvidersFactory
 *
 * @method PageDataProvider|null getPageDataProvider(Page $page)
 * @method string getPageDataProviderClass(Page $page)
 */
class DataProvidersFactory extends WireData
{
    /**
     * @var DataProvidersFactory The singleton instance of this class
     */
    protected static $instance;

    /**
     * Factory constructor.
     */
    public function __construct()
    {

    }

    /**
     * Retrieves the singleton instance of this class
     *
     * @return DataProvidersFactory
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) self::$instance = new DataProvidersFactory();

        return self::$instance;
    }

    /**
     * Creates a page data provider instance based on the given page
     *
     * @param Page $page
     * @return PageDataProvider|null
     * @throws DataProvidersFactoryException
     *          Data provider is not a subclass of \ffe\ProcessWire3\DataProviders\PageDataProvider
     */
    public function ___getPageDataProvider(Page $page)
    {
        $className = $this->getPageDataProviderClass($page);
        if (!class_exists($className)) return null; // stop if no suitable DataProvider class exists

        if (!is_subclass_of($className, '\ffe\ProcessWire3\DataProviders\PageDataProvider')) {
            throw new DataProvidersFactoryException('requested data provider [' . $className . '] '
                . 'is not a subclass of \ffe\ProcessWire3\DataProviders\PageDataProvider');
        }

        return new $className($page);
    }

    /**
     * Retrieves the suitable DataProvider's class name for the given Page
     *
     * Uses the page's template name to derive a suitable PageDataProvider class name prefixed with the configured
     * base namespace for DataProvider classes.
     *
     * Examples:
     *
     * - home               -> <BaseNS>\\HomePageDataProvider
     * - form-contact       -> <BaseNS>\\FormContactPageDataProvider
     *
     * @param Page $page
     * @return string
     */
    public function ___getPageDataProviderClass(Page $page)
    {
        $template = $page->template->name;
        $baseNs = \ProcessWire\wire('modules')->DataProviders->baseNs;
        $suffix = 'PageDataProvider';

        return $baseNs . '\\' . $this->pascalCaseStr($template) . $suffix;
    }

    /**
     * Retrieves the pascal-cased version of a string
     *
     * Examples:
     * - home               -> Home
     * - search_results     -> SearchResults
     * - primary-nav        -> PrimaryNav
     * - Header             -> Header
     *
     * @param string $str
     * @return string
     */
    protected function pascalCaseStr($str)
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', strtolower($str))));
    }
}
