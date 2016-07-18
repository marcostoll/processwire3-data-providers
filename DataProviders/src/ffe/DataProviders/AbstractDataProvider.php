<?php

/**
 * Class definition of AbstractDataProvider
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @version 1.0.0
 * @copyright 2016, Marco Stoll, https://github.com/marcostoll
 * @filesource
 */

namespace ffe\ProcessWire3\DataProviders;

use ProcessWire\WireData;

/**
 * Class AbstractDataProvider
 *
 * @method void populateAll()
 */
abstract class AbstractDataProvider extends WireData
{
    /**
     * Add data here
     *
     * Overwrite this method in concrete subclasses to provide
     * additional data for page or chunk rendering.
     *
     * Example for sub classes of PageDataProvider:
     *
     * <code>
     * public function populate()
     * {
     *      parent::populate();
     *      $this->wire('foo', 'bar');  // provides the fuel variable $foo to use within the page's template
     *      $this->page->foo = 'baz';   // provides page member $page->foo to use within the page's template
     * }
     * </code>
     */
    abstract public function populate();
}