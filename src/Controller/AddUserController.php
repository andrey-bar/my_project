<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddUserController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/add/user', name: 'app_add_user')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            if ($user instanceof User) {
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_list_users');
            }
        }

        return $this->render('add_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
