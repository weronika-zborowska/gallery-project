<?php
/**
 * Public photo controller.
 */

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller responsible for displaying public photo list.
 */
class PublicPhotoController extends AbstractController
{
    /**
     * Displays newest photos with pagination.
     *
     * @param Request         $request         Current HTTP request.
     * @param PhotoRepository $photoRepository Photo repository.
     *
     * @return Response HTTP response.
     */
    #[Route('/photos', name: 'app_public_photo_index')]
    public function index(Request $request, PhotoRepository $photoRepository): Response
    {
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $totalPhotos = $photoRepository->countAll();
        $totalPages = (int) ceil($totalPhotos / $limit);

        return $this->render('public_photo/index.html.twig', [
            'photos' => $photoRepository->findLatestPaginated($limit, $offset),
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
