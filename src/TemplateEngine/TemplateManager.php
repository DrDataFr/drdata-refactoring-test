<?php

namespace TemplateEngine;


class TemplateManager
{
    private array $vars = array();

    public function assign($key, $value)
    {
        $this->vars[$key] = $value;
    }

    /**
     * @param $text
     * @return array|mixed|string|string[]
     * Replace all key like [user:first_name] with value
     * todo: manage exceptions
     */
    public function render($text)
    {
        foreach ($this->vars as $key => $value) {
            $text = preg_replace('/\[' . $key . '\]/', $value, $text);
        }

        return $text;
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getIdHtml(int $id): string
    {
        return "<p> $id </p>";
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getIdText(int $id): string
    {
        return (string)$id;
    }
}