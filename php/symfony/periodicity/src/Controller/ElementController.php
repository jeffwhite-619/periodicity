<?php

namespace App\Controller;

use App\Service\Neo4jService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// use Neo4j\Neo4jBundle\Collector\Twig;
use GraphAware\Bolt\Result\Type\Node;

class ElementController extends AbstractController
{

    /**
     * @var Neo4jService
     */
    protected $service;

    public function __construct(Neo4jService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/element", name="element")
     */
    public function index()
    {
        $results  = $this->service->all()->records();
        $allNodes = [];
        foreach($results as $result) {
            $allNodes[] = $result->values()[0];
        }
        return $this->render('element/index.html.twig', [
            'controller_name' => 'ElementController',
            'allNodes'        => $allNodes,
        ]);
    }

    /**
     * @Route("/atoms", name="atoms")
     */
    public function atoms()
    {
        $results = $this->service->getElements();
        var_dump($results);
        die('TEST');
    }
}
