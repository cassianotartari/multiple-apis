<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['courses.service'] = function() {
            return new Services\CoursesService($this->app["db"]);
        };
    }
}

