<?php

namespace App\Controller;

use App\Repository\VacataireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class VacataireController extends AbstractController
{
    #[Route(' /vacataire', name: 'app_vacataire')]
    public function index(
        VacataireRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $vacataires = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt(key: 'page', default: 1),
            limit: 10
        );
        return $this->render('pages/vacataire/index.html.twig', [
            'vacataires' => $vacataires,
        ]);
    }
}
