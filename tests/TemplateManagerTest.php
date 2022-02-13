<?php

require_once __DIR__ . '/../src/Entity/Destination.php';
require_once __DIR__ . '/../src/Entity/Quote.php';
require_once __DIR__ . '/../src/Entity/Site.php';
require_once __DIR__ . '/../src/Entity/Template.php';
require_once __DIR__ . '/../src/Entity/User.php';
require_once __DIR__ . '/../src/Helper/SingletonTrait.php';
require_once __DIR__ . '/../src/Context/ApplicationContext.php';
require_once __DIR__ . '/../src/Repository/Repository.php';
require_once __DIR__ . '/../src/Repository/DestinationRepository.php';
require_once __DIR__ . '/../src/Repository/QuoteRepository.php';
require_once __DIR__ . '/../src/Repository/SiteRepository.php';
require_once __DIR__ . '/../src/TemplateManager.php';
require_once __DIR__ . '/../src/TemplateEngine/TemplateManager.php';
require_once __DIR__ . '/../src/Templates/ShippingInfoTemplate.php';

class TemplateManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Init the mocks
     */
    public function setUp()
    {
    }

    /**
     * Closes the mocks
     */
    public function tearDown()
    {
    }

    /**
     * @test
     * todo : create a other test method for each src/Templates and remove this when all deprecated calls are removed
     */
    public function test()
    {
        $faker = \Faker\Factory::create();

        $destinationId = $faker->randomNumber();
        $expectedDestination = DestinationRepository::getInstance()->getById($destinationId);
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();


        $quote = new Quote($faker->randomNumber(), $faker->randomNumber(), $destinationId, $faker->date());
        $expectedSite = SiteRepository::getInstance()->getById($quote->id);

        $template = new Template(
            1,
            'Votre livraison à [quote:destination_name]',
            "Bonjour [user:first_name],
            
            Merci de nous avoir contacté pour votre livraison ([quote:summary]) à [quote:destination_name].
            
            [quote:destination_link]
            
            Bien cordialement,
            
            L'équipe de Shipper");
        $deprecatedTemplateManager = new TemplateManager();

        $message = $deprecatedTemplateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote
            ]
        );



        $this->assertEquals("Votre livraison à $expectedDestination->countryName, $message->subject");
        $this->assertEquals("Bonjour $expectedUser->firstname,
                            
                            Merci de nous avoir contacté pour votre livraison ($quote->id) à $expectedDestination->countryName
                            
                             $expectedSite->url . '/' . $expectedDestination->countryName . '/quote/' . $quote->id
                            
                            Bien cordialement,
                            
                            L'équipe de Shipper",
            $message->content);
    }
}
