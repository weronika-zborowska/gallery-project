<?php
/**
 * Public gallery controller.
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Gallery;
use App\Entity\Photo;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\GalleryRepository;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller responsible for public gallery and photo views.
 */
class PublicGalleryController extends AbstractController
{
    /**
     * Displays public gallery list.
     *
     * @param GalleryRepository $galleryRepository Gallery repository.
     *
     * @return Response HTTP response.
     */
    #[Route('/', name: 'app_home')]
    public function index(GalleryRepository $galleryRepository): Response
    {
        return $this->render('public_gallery/index.html.twig', [
            'galleries' => $galleryRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    /**
     * Displays a photo with comments and handles comment creation.
     *
     * @param Photo                  $photo             Photo entity.
     * @param Request                $request           Current HTTP request.
     * @param CommentRepository      $commentRepository Comment repository.
     * @param EntityManagerInterface $entityManager     Entity manager.
     *
     * @return Response HTTP response.
     */
    #[Route('/photos/{id}', name: 'app_public_photo_show', methods: ['GET', 'POST'])]
    public function showPhoto(Photo $photo, Request $request, CommentRepository $commentRepository, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPhoto($photo);
            $comment->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Komentarz został dodany.');

            return $this->redirectToRoute('app_public_photo_show', [
                'id' => $photo->getId(),
            ]);
        }

        return $this->render('public_photo/show.html.twig', [
            'photo' => $photo,
            'comments' => $commentRepository->findBy(
                ['photo' => $photo],
                ['createdAt' => 'DESC']
            ),
            'commentForm' => $form,
        ]);
    }

    /**
     * Displays selected gallery with assigned photos.
     *
     * @param Gallery         $gallery         Gallery entity.
     * @param PhotoRepository $photoRepository Photo repository.
     *
     * @return Response HTTP response.
     */
    #[Route('/galleries/{id}', name: 'app_public_gallery_show')]
    public function showGallery(Gallery $gallery, PhotoRepository $photoRepository): Response
    {
        return $this->render('public_gallery/show.html.twig', [
            'gallery' => $gallery,
            'photos' => $photoRepository->findBy(
                ['gallery' => $gallery],
                ['createdAt' => 'DESC']
            ),
        ]);
    }
}
