<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductsRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }
    
    #[Route("/product/{id}/details", name:"product.detail")]
    public function detail(ProductController $product):Response
    {
        return $this->render('product/detail.html.twig',[
            'product' => $product,
        ]);
    }
}
