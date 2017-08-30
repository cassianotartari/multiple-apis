<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['courses.controller'] = function() {
            return new Controllers\CoursesController($this->app['courses.service']);
        };
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/', "courses.controller:index");
        $api->get('/courses', "courses.controller:getAll");
        $api->get('/courses/{id}', "courses.controller:getOne");
        $api->post('/courses', "courses.controller:save");
        $api->put('/courses/{id}', "courses.controller:update");
        $api->delete('/courses/{id}', "courses.controller:delete");
        $api->get('/courses/page/{page}', "courses.controller:getPaginated");

        $this->app->mount('/', $api);
    }
}

