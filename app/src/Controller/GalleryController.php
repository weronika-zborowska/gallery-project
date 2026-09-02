<?php

/**
 * Gallery controller.
 */

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Repository\GalleryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Controller responsible for gallery management.
 */
#[IsGranted('ROLE_ADMIN')]
#[Route('/gallery')]
final class GalleryController extends AbstractController
{
    /**
     * Displays gallery list.
     *
     * @param GalleryRepository $galleryRepository gallery repository
     *
     * @return Response HTTP response
     */
    #[Route(name: 'app_gallery_index', methods: ['GET'])]
    public function index(GalleryRepository $galleryRepository): Response
    {
        return $this->render('gallery/index.html.twig', [
            'galleries' => $galleryRepository->findAll(),
        ]);
    }

    /**
     * Creates a new gallery.
     *
     * @param Request                $request       current request
     * @param EntityManagerInterface $entityManager entity manager
     *
     * @return Response HTTP response
     */
    #[Route('/new', name: 'app_gallery_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gallery = new Gallery();
        $form = $this->createForm(GalleryType::class, $gallery, [
            'method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gallery);
            $entityManager->flush();

            $this->addFlash('success', 'Galeria została dodana.');

            return $this->redirectToRoute(
                'app_gallery_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        if ($form->isSubmitted()) {
            $this->addFlash(
                'error',
                'Nie udało się dodać galerii. Sprawdź poprawność danych.'
            );
        }

        return $this->render('gallery/new.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    /**
     * Displays gallery details.
     *
     * @param Gallery $gallery gallery entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'app_gallery_show', methods: ['GET'])]
    public function show(Gallery $gallery): Response
    {
        return $this->render('gallery/show.html.twig', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Edits an existing gallery.
     *
     * @param Request                $request       current request
     * @param Gallery                $gallery       gallery entity
     * @param EntityManagerInterface $entityManager entity manager
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'app_gallery_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, Gallery $gallery, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Galeria została zaktualizowana.');

            return $this->redirectToRoute(
                'app_gallery_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        if ($form->isSubmitted()) {
            $this->addFlash(
                'error',
                'Nie udało się zaktualizować galerii. Sprawdź poprawność danych.'
            );
        }

        return $this->render('gallery/edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    /**
     * Deletes a gallery.
     *
     * @param Request                $request       current request
     * @param Gallery                $gallery       gallery entity
     * @param EntityManagerInterface $entityManager entity manager
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'app_gallery_delete', methods: ['DELETE'])]
    public function delete(Request $request, Gallery $gallery, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid(
            'delete'.$gallery->getId(),
            $request->getPayload()->getString('_token')
        )) {
            $entityManager->remove($gallery);
            $entityManager->flush();

            $this->addFlash('success', 'Galeria została usunięta.');
        } else {
            $this->addFlash('error', 'Nie udało się usunąć galerii.');
        }

        return $this->redirectToRoute(
            'app_gallery_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
