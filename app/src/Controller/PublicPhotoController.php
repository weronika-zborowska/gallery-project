<?php

/**
 * Public photo controller.
 */

namespace App\Controller;

use App\Repository\PhotoRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @param Request            $request         current HTTP request
     * @param PhotoRepository    $photoRepository photo repository
     * @param PaginatorInterface $paginator       paginator
     *
     * @return Response HTTP response
     */
    #[Route('/photos', name: 'app_public_photo_index')]
    public function index(Request $request, PhotoRepository $photoRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $photoRepository->getLatestQueryBuilder(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('public_photo/index.html.twig', [
            'photos' => $pagination,
        ]);
    }
}
