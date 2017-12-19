<?php

use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Backend_TinyMceCustomFont extends \Enlight_Controller_Action implements CSRFWhitelistAware
{
    public function indexAction()
    {
        $this->container->get('front')->Plugins()->ViewRenderer()->setNoRender();
        $config = $this->container->get('shopware.plugin.config_reader')->getByPluginName('SwagTinyMceCustomFont');

        if (!isset($config['urls']) || empty($config['urls'])) {
            echo '';
        } else {
            $fontUrls = explode("\n", $config['urls']);
            $fontUrls = array_filter($fontUrls);

            $this->Response()->setHeader('Content-Type', 'text/css; charset=utf-8');

            foreach($fontUrls as $files) {
                echo "@import url('" . $files . "');\n";
            }
        }
    }

    /**
     * Returns a list with actions which should not be validated for CSRF protection
     *
     * @return string[]
     */
    public function getWhitelistedCSRFActions()
    {
        return ['index'];
    }
}