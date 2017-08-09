<?php
namespace SwagTinyMceCustomFont;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Theme\LessDefinition;

class SwagTinyMceCustomFont extends \Shopware\Components\Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Backend_Index' => 'onBackendIndexPostDispatch',
            'Theme_Compiler_Collect_Plugin_Less' => 'onCollectPluginLess'
        ];
    }

    /**
     * @param \Enlight_Controller_EventArgs|\Enlight_Event_EventArgs $args
     */
    public function onBackendIndexPostDispatch(\Enlight_Event_EventArgs $args)
    {
        $controller = $args->getSubject();
        $view = $controller->View();

        $config = $this->container->get('shopware.plugin.config_reader')->getByPluginName($this->getName());

        $view->assign('tinyMceCustomFontConfig', $config);
        $view->addTemplateDir($this->getPath() . '/Resources/Views');
        $view->extendsTemplate('backend/swag_tiny_mce_custom_font/include.tpl');
    }

    public function onCollectPluginLess() {

        $lessFiles = [
            $this->getPath() . '/Resources/Views/frontend/_public/src/less/all.less'
        ];

        $config = $this->container->get('shopware.plugin.config_reader')->getByPluginName($this->getName());

        if (!$config['urls']) {
            return new ArrayCollection();
        }

        $fontUrls = explode("\n", $config['urls']);
        $fontUrls = array_filter($fontUrls);

        $fonts = [];
        foreach($fontUrls as $file) {
            $fonts[] = new LessDefinition([
                'fontUrl' => '"' . $file . '"'
            ], $lessFiles, $this->getPath());
        }

        return new ArrayCollection($fonts);

    }

}