<?php

namespace App\Controller;

use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $repo): Response
    {
        $products = $repo->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $products
        ]);
    }

    #[Route('/produit/edit/{id}', name: 'produit_edit')]
    public function edit($id, ProduitRepository $repo, Request $request)
    {
        $product = $repo->find($id);

        $form = $this->createForm(ProduitType::class, $product);

        $form->handleRequest($request);

        $formView = $form->createView();

        return $this->render('produit/edit.html.twig', [
            'product' => $product,
            'form' => $formView
        ]);
    }
}
