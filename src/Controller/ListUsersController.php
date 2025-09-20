<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListUsersController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    #[Route('/list/users', name: 'app_list_users')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('list_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
