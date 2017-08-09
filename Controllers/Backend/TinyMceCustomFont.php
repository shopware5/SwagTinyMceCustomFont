<?php
class Shopware_Controllers_Backend_TinyMceCustomFont extends \Enlight_Controller_Action
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
}