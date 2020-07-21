<?php

namespace App\Controller;

use App\Service\Neo4jMoleculeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MoleculeController extends AbstractController
{

    /**  @var Neo4jMoleculeService */
    protected $service;

    public function __construct(Neo4jMoleculeService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/element", name="element")
     */
    public function index()
    {
        return $this->render('molecule/index.html.twig', [
            'controller_name' => 'MoleculeController',
        ]);
    }
}
