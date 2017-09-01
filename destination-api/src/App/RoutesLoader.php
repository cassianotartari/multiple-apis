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

        $api->post('/courses', "courses.controller:save");
        $api->get('/', "courses.controller:index");
        $api->get('/courses', "courses.controller:getAll");

        $this->app->mount('/', $api);
    }
}

