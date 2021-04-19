<?php

namespace App\Controller\Api;

use App\Repository\TripRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class TripApiController extends AbstractController
{
    /**
     * @Route("/api/trips/search-by", name="api_search_trips", methods={"GET"})
     * @OA\Response(description="OK", response=200)
     * @OA\Tag(name="Trip")
     */
    public function index(Request $request, TripRepository $repository): Response
    {
        try {
            $offset = $request->query->get('offset', 0);
            $limit = $request->query->get('limit', 6);
            $filter = $request->query->get('filter') ?? [];
            $trips = $repository->findBy($filter, ['id' => 'DESC'], $limit, $offset);
            return $this->json($trips);
        } catch (Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * @Route("/api/trips/countries", name="api_trips_countries", methods={"GET"})
     * @OA\Response(description="OK", response=200)
     * @OA\Tag(name="Trip")
     */
    public function countries(TripRepository $repository): Response
    {
        try {
            $result = $repository->createQueryBuilder('t')
                ->select('t.country')
                ->groupBy('t.country')
                ->getQuery()
                ->getResult()
            ;
            return $this->json($result);
        } catch (Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
