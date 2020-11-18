<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param Environment $twig
     * @param ConferenceRepository $conferenceRepository
     * @return Response
     */
    public function index(Environment $twig, ConferenceRepository $conferenceRepository)
    {
        return new Response($twig->render('conference/index.html.twig',
            ['conferences' => $conferenceRepository->findAll(),
                'controller_name' => 'Conference']));
    }

    /**
     * @Route("/conference/{id}",name="conference")
     * @param Request $request
     * @param Environment $twig
     * @param Conference $conference
     * @param CommentRepository $commentRepository
     * @return Response
     */
    public function show(Request $request, Environment $twig, Conference $conference, CommentRepository $commentRepository)
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);
        return new Response($twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE)
        ]));

    }
}
