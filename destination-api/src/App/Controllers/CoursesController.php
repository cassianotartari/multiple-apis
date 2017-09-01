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
        $note = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->coursesService->save($note)));
    }

    public function getDataFromRequest(Request $request)
    {
        return $note = array(
            "course" => $request->request->get("course")
        );
    }
}
