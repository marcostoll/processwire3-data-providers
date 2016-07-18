<?php

/**
 * Class definition of PageDataProvider
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @version 1.0.0
 * @copyright 2016, Marco Stoll, https://github.com/marcostoll
 * @filesource
 */

namespace ffe\ProcessWire3\DataProviders;

use ProcessWire\Page;

/**
 * Class PageDataProvider
 */
class PageDataProvider extends AbstractDataProvider
{
    /**
     * @var Page $page
     */
    protected $page;

    /**
     * Generic constructor
     *
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->setPage($page);
    }

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
    public function populate()
    {
        parent::populate();
    }

    /**
     * Retrieves the page
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Sets the page
     *
     * @param Page $page
     * @return $this
     */
    public function setPage(Page $page)
    {
        $this->page = $page;

        return $this;
    }
}