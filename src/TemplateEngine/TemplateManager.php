<?php

namespace TemplateEngine;

use ApplicationContext;
use DestinationRepository;
use Quote;
use QuoteRepository;
use SiteRepository;
use User;


class TemplateManager
{
    /**
     * @param $text
     * @param array $data
     * @return array|mixed|string|string[]
     */
    public function computeText($text, array $data)
    {

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote) {
            $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
            $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);

            if (strpos($text, '[quote:destination_link]') !== false) {
                $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        self::getIdHtml($_quoteFromRepository->id),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        self::getIdText($_quoteFromRepository->id),
                        $text
                    );
                }
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]', $destinationOfQuote->countryName, $text);
        }

        if (isset($destination))
            $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->id, $text);
        else
            $text = str_replace('[quote:destination_link]', '', $text);


        $applicationContext = ApplicationContext::getInstance();
        $_user = (isset($data['user']) and ($data['user'] instanceof User)) ? $data['user'] : $applicationContext->getCurrentUser();
        if ($_user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]', ucfirst(mb_strtolower($_user->firstname)), $text);
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