<?php

/**
 * @deprecated deprecated since fake version 1.26.0
 */
class TemplateManager
{
    /**
     * @param Template $template
     * @param array $data
     * @return Template
     * @deprecated deprecated since fake version 1.26.0
     * Careful if you want to change the signature of this method because there are many calls
     */
    public function getTemplateComputed(Template $template, array $data)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);

        $templateManager = new \TemplateEngine\TemplateManager();
        $replaced = clone($template);
        $replaced->subject = $templateManager->computeText($replaced->subject, $data);
        $replaced->content = $templateManager->computeText($replaced->content, $data);

        return $replaced;
    }
}
