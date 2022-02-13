<?php

namespace Templates;

use ApplicationContext;
use DestinationRepository;
use Quote;
use QuoteRepository;
use SiteRepository;
use TemplateEngine\TemplateManager;
use User;

class ShippingInfoTemplate
{
    /**
     * @param TemplateManager $templateManager
     * @param array $data
     * Assign variables to be replaced in the template
     */
    public function assign(TemplateManager $templateManager, array $data)
    {

        if (isset($data['quote']) and $data['quote'] instanceof Quote) {
            $quote = $data['quote'];
            $quoteRepository = QuoteRepository::getInstance()->getById($quote->id);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);
            $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);

            $templateManager->assign('quote:summary_html', $templateManager->getIdHtml($quoteRepository->id));
            $templateManager->assign('quote:summary', $templateManager->getIdText($quoteRepository->id));
            $templateManager->assign('quote:destination_name', $destinationOfQuote->countryName);

            if ($destination and $usefulObject and $quoteRepository) {
                $templateManager->assign('quote:destination_link', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $quoteRepository->id);
            } else {
                $templateManager->assign('quote:destination_link', '');
            }
        }

        $user = $data['user'] ?? ApplicationContext::getInstance()->getCurrentUser();
        if ($user instanceof User) {
            $templateManager->assign('user:first_name', ucfirst(mb_strtolower($user->firstname)));
        }
        //todo: manage exceptions
    }
}