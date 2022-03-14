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

    #[Route('/new', name: 'app_orderdetail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrderdetailRepository $orderdetailRepository): Response
    {
        $orderdetail = new Orderdetail();
        $form = $this->createForm(OrderdetailType::class, $orderdetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderdetailRepository->add($orderdetail);
            return $this->redirectToRoute('app_orderdetail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orderdetail/new.html.twig', [
            'orderdetail' => $orderdetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orderdetail_show', methods: ['GET'])]
    public function show(Orderdetail $orderdetail): Response
    {
        return $this->render('orderdetail/show.html.twig', [
            'orderdetail' => $orderdetail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_orderdetail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Orderdetail $orderdetail, OrderdetailRepository $orderdetailRepository): Response
    {
        $form = $this->createForm(OrderdetailType::class, $orderdetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderdetailRepository->add($orderdetail);
            return $this->redirectToRoute('app_orderdetail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orderdetail/edit.html.twig', [
            'orderdetail' => $orderdetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orderdetail_delete', methods: ['POST'])]
    public function delete(Request $request, Orderdetail $orderdetail, OrderdetailRepository $orderdetailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderdetail->getId(), $request->request->get('_token'))) {
            $orderdetailRepository->remove($orderdetail);
        }

        return $this->redirectToRoute('app_orderdetail_index', [], Response::HTTP_SEE_OTHER);
    }
}
