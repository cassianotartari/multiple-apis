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
    
    protected $pageSize = 3;

    public function __construct($service)
    {
        $this->coursesService = $service;
    }

    public function index()
    {
        return new JsonResponse('source-api');
    }
    
    public function getPaginated($page) {
        $page = $page < 0 ? 0 : $page;
        $prev = "http://source-api/courses/".$page;
        $next = "http://source-api/courses/".($page+1);
        return new JsonResponse([
            'prev' => $prev,
            'next' => $next,
            'data' => $this->coursesService->getPaginated($this->pageSize, $page)
        ]);
    }

    public function getOne($id)
    {
        return new JsonResponse($this->coursesService->getOne($id));
    }

    public function getAll()
    {
        return new JsonResponse($this->coursesService->getAll());
    }

    public function save(Request $request)
    {

        $note = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->coursesService->save($note)));

    }

    public function update($id, Request $request)
    {
        $note = $this->getDataFromRequest($request);
        $this->coursesService->update($id, $note);
        return new JsonResponse($note);

    }

    public function delete($id)
    {

        return new JsonResponse($this->coursesService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return $note = array(
            "note" => $request->request->get("note")
        );
    }
}
