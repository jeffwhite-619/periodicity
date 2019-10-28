<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\GraphFixtures\ElementFixtures;

class Neo4jFixturesLoadCommand extends Command
{
    protected static $defaultName = 'neo4j:fixtures:load';

    /**
     * @var ElementFixtures
     */
    protected $fixtures;

    public function __construct(ElementFixtures $fixtures)
    {
        parent::__construct(self::class);
        $this->fixtures = $fixtures;
    }

    protected function configure()
    {
        $this->setDescription('Load fixtures for Periodicity into Neo4j');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->fixtures->load();
        $io = new SymfonyStyle($input, $output);
        $io->success('Periodicity graph database seeded in Neo4j');
    }
}
