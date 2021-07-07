<?php

namespace Whizz\Gallery\Controller;

use Whizz\Gallery\Exception\RequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Whizz\Gallery\Repository\CategoryRepository;
use Whizz\Gallery\Service\CategoryService;

class GalleryController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        CategoryService $categoryService,
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $payload = json_decode($request->getContent(), true);

            $this->categoryService->createCategory($payload);

            return JsonResponse::create('', Response::HTTP_OK, [], true);

        } catch (RequestException $e) {
            return JsonResponse::create(
                [
                    $this->messageKey => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function list(Request $request): JsonResponse
    {
        try {
            $json = $this->categoryRepository->list();

            return JsonResponse::create($json, Response::HTTP_OK, [], true);

        } catch (RequestException $e) {
            return JsonResponse::create(
                [
                    $this->messageKey => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}