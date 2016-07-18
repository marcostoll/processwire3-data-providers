<?php

/**
 * Class definition of DataProvidersConfig
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @version 1.0.0
 * @copyright 2016, Marco Stoll, https://github.com/marcostoll
 * @filesource
 */

namespace ffe\ProcessWire3;

use ProcessWire\ModuleConfig;

/**
 * Class DataProvidersConfig
 *
 * @package ffe/ProcessWire3
 */
class DataProvidersConfig extends ModuleConfig
{
    /**
     * DataProvidersConfig constructor.
     */
    public function __construct()
    {
        $this->add([
            [
                'name' => 'baseNs',
                'label' => 'Data Providers Base Namespace',
                'type' => 'text',
                'required' => true,
                'value' => '',
                'placeholder' => 'base namespace of your site\'s data provider classes',
                'description' => 'Insert base namespace of your site\'s data provider classes.',
                'notes' => 'Example: My\Site\DataProviders (PSR-4 style)'
            ],
            [
                'name' => 'basePath',
                'label' => 'Data Providers Base Path',
                'type' => 'text',
                'value' => 'site/dataproviders',
                'placeholder' => 'base directory storing the data provider class files',
                'description' => 'Insert the base directory name for storing the data provider class files '
                    . '(relative to $config->paths->root).',
                'notes' => 'The namespaced DataProvider classes must be located in subdirectories according to the '
                    . 'base namespace (PSR-4 style). E.g. a DataProvider class '
                    . '"My\Site\DataProviders\Forms\ContactFormDataProvider" must be located in '
                    . '"path/to/dataproviders/Forms/ContactFormDataProvider.php"'
            ]
        ]);
    }
}
