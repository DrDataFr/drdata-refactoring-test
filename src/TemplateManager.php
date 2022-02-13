<?php

use Templates\ShippingInfoTemplate;

/**
 * @deprecated deprecated since fake version 1.26.0 please create a template in src/Templates/*
 */
class TemplateManager
{
    /**
     * @param Template $template
     * @param array $data
     * @return Template
     * @deprecated deprecated since fake version 1.26.0 please create a template in src/Templates/*
     * Careful if you want to change the signature of this method because there are many calls
     */
    public function getTemplateComputed(Template $template, array $data)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);

        $shippingInfoTemplate = new ShippingInfoTemplate();
        $templateManager = new \TemplateEngine\TemplateManager();
        $replaced = clone($template);

        $shippingInfoTemplate->assign($templateManager, $data);
        $replaced->subject = $templateManager->render($replaced->subject);
        $replaced->content = $templateManager->render($replaced->content);

        return $replaced;
    }
}
