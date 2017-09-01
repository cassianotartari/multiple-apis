<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use AppBundle\Entity\SourceApiX;
use AppBundle\Entity\SourceApiXCourse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->copyApi();
//        return new Response("symfony");
    }
    
    private function getSourceClient()
    {
        return new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://source-service',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
    }
    
    private function getSourceCourseListContent($url)
    {
        $sourceClient = $this->getSourceClient();

        $courseListResponse = $sourceClient->get($url);

        $couseListBodyContent = $courseListResponse
                ->getBody()
                ->getContents();

        return json_decode($couseListBodyContent, true);
    }
    
    private function getCourse($id)
    {
        return $this->getSourceClient()->get('/courses/'.$id);
    }


    private function getSourceCourseContent($id)
    {

        $courseBodyContent = $this->getCourse($id)
            ->getBody()
            ->getContents();

        return json_decode($courseBodyContent, true);
    }

    public function copyApi()
    {
        $sourceApi = new SourceApiX();
        
        $courseList = $this->getSourceCourseListContent('/courses');

        do {
            foreach ($courseList['data'] as $courseId)
            {
                $course = $this->getSourceCourseContent(array_shift($courseId));
                
                $sourceApiXCourse = new SourceApiXCourse(
                    (string) $course['id'],
                    (string) $course['name'],
                    (string) $course['grade']
                );
                $sourceApi->addCourse($sourceApiXCourse);
            }
            $courseList = $this->getSourceCourseListContent($courseList['next']);
        } while ($courseList['next'] !== '');
        
        $destinationCourses = $sourceApi->getDestinationCourses();
        return new Response($this->postToDestinationApi($destinationCourses)->getBody()->getContents());
    }
    
    private function postToDestinationApi($destinationCourses) {
        $destinationClient = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://destination-service',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        return $destinationClient->post('/courses', [
            'json' => [
                'courses' => $destinationCourses
            ]
        ]);
    }
            
}
