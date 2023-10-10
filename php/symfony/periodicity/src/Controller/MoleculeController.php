<?php

namespace App\Controller;

use App\Service\Neo4jMoleculeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MoleculeController extends AbstractController
{

    /**  @var Neo4jMoleculeService */
    protected $service;

    /**
     * @param Neo4jMoleculeService $service
     */
    public function __construct(Neo4jMoleculeService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/molecule", name="molecule", methods={"GET"})
     */
    public function index()
    {
        return $this->render('molecule/index.html.twig', [
            'controller_name' => 'MoleculeController',
        ]);
    }

    /**
     * @Route("/molecule/{moleculeName}", name="molecule-async", methods={"GET"})
     * 
     * @param string $moleculeName
     * @return JsonResponse
     */
    public function molecule(string $moleculeName): JsonResponse
    {
        $molecule = $this->service->getMolecule(urldecode($moleculeName));
        return new JsonResponse($molecule, JsonResponse::HTTP_OK);
    }
}
