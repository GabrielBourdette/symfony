<?php
namespace App\Tests\Controller;

use App\Controller\CardController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;


class MainControllerTest extends WebTestCase
{
	

	public function test_home() {

		$client = static::createClient();
        $crawler = $client->request('GET', '/product');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        echo "\n Code réponse de la page Accueil : ".$client->getResponse()->getStatusCode();

        $this->assertCount(6, $crawler->filter('.product_bloc'));
        echo "\n Nombre de produits sur la page Accueil : ".$crawler->filter('.product_bloc')->count();

	}


	// commande : php bin/phpunit


}