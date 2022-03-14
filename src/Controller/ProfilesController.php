<?php

namespace App\Controller;

use App\Entity\Profiles;
use App\Form\ProfilesType;
use App\Repository\ProfilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profiles')]
class ProfilesController extends AbstractController
{
    #[Route('/', name: 'app_profiles_index', methods: ['GET'])]
    public function index(ProfilesRepository $profilesRepository): Response
    {
        return $this->render('profiles/index.html.twig', [
            'profiles' => $profilesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profiles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProfilesRepository $profilesRepository): Response
    {
        $profile = new Profiles();
        $form = $this->createForm(ProfilesType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilesRepository->add($profile);
            return $this->redirectToRoute('app_profiles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profiles/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profiles_show', methods: ['GET'])]
    public function show(Profiles $profile): Response
    {
        return $this->render('profiles/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profiles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profiles $profile, ProfilesRepository $profilesRepository): Response
    {
        $form = $this->createForm(ProfilesType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilesRepository->add($profile);
            return $this->redirectToRoute('app_profiles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profiles/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profiles_delete', methods: ['POST'])]
    public function delete(Request $request, Profiles $profile, ProfilesRepository $profilesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $profilesRepository->remove($profile);
        }

        return $this->redirectToRoute('app_profiles_index', [], Response::HTTP_SEE_OTHER);
    }
}
