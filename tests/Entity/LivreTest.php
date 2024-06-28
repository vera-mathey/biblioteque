<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Livre;

class LivreTest extends WebTestCase
{
    public function testGetterAndSetter(): void
    {
        //Instancier la classe
        $livre = new Livre();

        $livre->setTitle('Test title');
        $this->assertEquals('Test title', $livre->getTitle());

        $livre->setAbstract('Test abstract');
        $this->assertEquals('Test abstract', $livre->getAbstract());

        $livre->setContent('Test content');
        $this->assertEquals('Test content', $livre->getContent());

        $livre->setImage('Test image');
        $this->assertEquals('Test image', $livre->getImage());

        $createdAt = new \DateTimeImmutable('2022-03-18 12:00:00');
        $livre->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $livre->getCreatedAt());

    }
}
