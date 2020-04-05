<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $product = new Product('espadrilles_multicolores', 'espadrilles multicolores', 'bleu jaune vert rouge', 25.0, 'multicolore.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_bleues', 'espadrilles bleues', 'bleu bleu beu', 15.50, 'bleu.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_jaunes', 'espadrilles jaunes', 'jaune jaune jaune', 19.50, 'jaune.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_rouges', 'espadrilles rouges', 'rouge rouge rouge', 18.50, 'rouge.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_vertes', 'espadrilles vertes', 'vert vert vert', 19.50, 'vert.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_noires', 'espadrilles noires', 'noir noir noir', 19.0, 'noir.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_blanches', 'espadrilles blanches', 'blanc blanc blanc', 21.50, 'blanc.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_blanches_bleues', 'espadrilles blanches et bleues', 'blanc bleu blanc', 14.50, 'bleu_blanc.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_blanches_rouges', 'espadrilles blanches et rouges', 'blanc rouge blanc', 20.50, 'rouge_blanc.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles beiges', 'espadrilles_beiges', 'beige beige beige', 16.50, 'beige.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_violettes', 'espadrilles violettes', 'violet violet violet', 19.50, 'violet.jpg');
        $manager->persist($product);

        $product = new Product('espadrilles_oranges', 'espadrilles oranges', 'orange orange orange', 19.0, 'orange.jpg');
        $manager->persist($product);

        $manager->flush();


        // commande : php bin/console doctrine:fixtures:load
    }
}
