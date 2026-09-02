<?php

/**
 * Photo controller.
 */

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use App\Repository\PhotoRepository;
use App\Service\PhotoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Controller responsible for photo management.
 */
#[IsGranted('ROLE_ADMIN')]
#[Route('/photo')]
final class PhotoController extends AbstractController
{
    /**
     * Displays photo list.
     *
     * @param PhotoRepository $photoRepository photo repository
     *
     * @return Response HTTP response
     */
    #[Route(name: 'app_photo_index', methods: ['GET'])]
    public function index(PhotoRepository $photoRepository): Response
    {
        return $this->render('photo/index.html.twig', [
            'photos' => $photoRepository->findAll(),
        ]);
    }

    /**
     * Creates a new photo.
     *
     * @param Request      $request      current request
     * @param PhotoService $photoService photo service
     *
     * @return Response HTTP response
     */
    #[Route('/new', name: 'app_photo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhotoService $photoService): Response
    {
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            $photoService->create($photo, $imageFile);

            $this->addFlash('success', 'Zdjęcie zostało dodane.');

            return $this->redirectToRoute(
                'app_photo_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('photo/new.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }

    /**
     * Displays photo details.
     *
     * @param Photo $photo photo entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'app_photo_show', methods: ['GET'])]
    public function show(Photo $photo): Response
    {
        return $this->render('photo/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    /**
     * Edits an existing photo.
     *
     * @param Request      $request      current request
     * @param Photo        $photo        photo entity
     * @param PhotoService $photoService photo service
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'app_photo_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, Photo $photo, PhotoService $photoService): Response
    {
        $form = $this->createForm(PhotoType::class, $photo, [
            'method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            $photoService->update($photo, $imageFile);

            $this->addFlash('success', 'Zdjęcie zostało zaktualizowane.');

            return $this->redirectToRoute(
                'app_photo_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('photo/edit.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }

    /**
     * Deletes a photo.
     *
     * @param Request                $request       current request
     * @param Photo                  $photo         photo entity
     * @param EntityManagerInterface $entityManager entity manager
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'app_photo_delete', methods: ['DELETE'])]
    public function delete(Request $request, Photo $photo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid(
            'delete'.$photo->getId(),
            $request->getPayload()->getString('_token')
        )) {
            $entityManager->remove($photo);
            $entityManager->flush();

            $this->addFlash('success', 'Zdjęcie zostało usunięte.');
        } else {
            $this->addFlash('error', 'Nie udało się usunąć zdjęcia.');
        }

        return $this->redirectToRoute(
            'app_photo_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
