<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Form\AccountsType;
use App\Repository\AccountsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accounts')]
class AccountsController extends AbstractController
{
    #[Route('/', name: 'app_accounts_index', methods: ['GET'])]
    public function index(AccountsRepository $accountsRepository): Response
    {
        return $this->render('accounts/index.html.twig', [
            'accounts' => $accountsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accounts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AccountsRepository $accountsRepository): Response
    {
        $account = new Accounts();
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accountsRepository->add($account);
            return $this->redirectToRoute('app_accounts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('accounts/new.html.twig', [
            'account' => $account,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounts_show', methods: ['GET'])]
    public function show(Accounts $account): Response
    {
        return $this->render('accounts/show.html.twig', [
            'account' => $account,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_accounts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Accounts $account, AccountsRepository $accountsRepository): Response
    {
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accountsRepository->add($account);
            return $this->redirectToRoute('app_accounts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('accounts/edit.html.twig', [
            'account' => $account,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounts_delete', methods: ['POST'])]
    public function delete(Request $request, Accounts $account, AccountsRepository $accountsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$account->getId(), $request->request->get('_token'))) {
            $accountsRepository->remove($account);
        }

        return $this->redirectToRoute('app_accounts_index', [], Response::HTTP_SEE_OTHER);
    }
}
