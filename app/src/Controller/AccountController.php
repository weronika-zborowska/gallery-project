<?php
/**
 * Account controller.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Controller responsible for account management.
 */
#[IsGranted('ROLE_ADMIN')]
final class AccountController extends AbstractController
{
    /**
     * Displays account dashboard.
     *
     * @return Response HTTP response.
     */
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    /**
     * Displays and processes account edit form.
     *
     * @param Request                $request       Current request.
     * @param EntityManagerInterface $entityManager Entity manager.
     *
     * @return Response HTTP response.
     */
    #[Route('/account/edit', name: 'app_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Dane konta zostały zmienione.');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Displays and processes password change form.
     *
     * @param Request                     $request        Current request.
     * @param EntityManagerInterface      $entityManager  Entity manager.
     * @param UserPasswordHasherInterface $passwordHasher Password hasher.
     *
     * @return Response HTTP response.
     */
    #[Route('/account/password', name: 'app_account_password', methods: ['GET', 'POST'])]
    public function changePassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setPassword(
                $passwordHasher->hashPassword($user, $plainPassword)
            );

            $entityManager->flush();

            $this->addFlash('success', 'Hasło zostało zmienione.');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/change_password.html.twig', [
            'form' => $form,
        ]);
    }
}
