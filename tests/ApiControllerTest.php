<?php

namespace App\Tests;

use App\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testAjoutp()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/ajoutp',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{
            "nom":"sun",
            "rs": "hj",
            "ninea": 1588,
            "adresse": "point E",
            "statut": "debloquer"
        }');
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
}

