<?php

namespace App\Controller;

use App\Entity\Orderdetail;
use App\Form\OrderdetailType;
use App\Repository\OrderdetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orderdetail')]
class OrderdetailController extends AbstractController
{
    #[Route('/', name: 'app_orderdetail_index', methods: ['GET'])]
    public function index(OrderdetailRepository $orderdetailRepository): Response
    {
        return $this->render('orderdetail/index.html.twig', [
            'orderdetails' => $orderdetailRepository->findAll(),
        ]);
    }
}
