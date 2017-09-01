<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CoursesController
{

    /**
     *
     * @var \App\Services\CoursesService
     */
    protected $coursesService;

    public function __construct($service)
    {
        $this->coursesService = $service;
    }

    public function index()
    {
        return new JsonResponse('destination-api');
    }
    
    public function save(Request $request)
    {
        $courses = $this->getDataFromRequest($request);
        $ids = [];
        foreach ($courses as $course) {
            $ids[] = $this->coursesService->save($course);
        }
        if(count($ids)) {
            return new JsonResponse($ids, Response::HTTP_CREATED);
        }
        return  new JsonResponse("", Response::HTTP_BAD_REQUEST);
    }

    public function getDataFromRequest(Request $request)
    {
        return $request->request->get("courses");
    }
    
    public function getAll()
    {
        return new JsonResponse($this->coursesService->getAll());
    }
}
