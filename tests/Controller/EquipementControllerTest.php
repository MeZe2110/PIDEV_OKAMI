<?php

namespace App\Test\Controller;

use App\Entity\Equipement;
use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EquipementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EquipementRepository $repository;
    private string $path = '/equipement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Equipement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Equipement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'equipement[nomeq]' => 'Testing',
            'equipement[etateq]' => 'Testing',
            'equipement[dispoeq]' => 'Testing',
            'equipement[cate]' => 'Testing',
        ]);

        self::assertResponseRedirects('/equipement/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Equipement();
        $fixture->setNomeq('My Title');
        $fixture->setEtateq('My Title');
        $fixture->setDispoeq('My Title');
        $fixture->setCate('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Equipement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Equipement();
        $fixture->setNomeq('My Title');
        $fixture->setEtateq('My Title');
        $fixture->setDispoeq('My Title');
        $fixture->setCate('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'equipement[nomeq]' => 'Something New',
            'equipement[etateq]' => 'Something New',
            'equipement[dispoeq]' => 'Something New',
            'equipement[cate]' => 'Something New',
        ]);

        self::assertResponseRedirects('/equipement/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomeq());
        self::assertSame('Something New', $fixture[0]->getEtateq());
        self::assertSame('Something New', $fixture[0]->getDispoeq());
        self::assertSame('Something New', $fixture[0]->getCate());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Equipement();
        $fixture->setNomeq('My Title');
        $fixture->setEtateq('My Title');
        $fixture->setDispoeq('My Title');
        $fixture->setCate('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/equipement/');
    }
}
