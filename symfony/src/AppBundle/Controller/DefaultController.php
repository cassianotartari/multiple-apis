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
        return new Response("symfony");
    }
    
    private function getSourceCourseListContent($url)
    {
        $sourceClient = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://source-service/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $courseListResponse = $sourceClient->get($url);

        $couseListBodyContent = $courseListResponse
                ->getBody()
                ->getContents();

        return json_decode($couseListBodyContent, true);
    }
    
    private function getSourceCourseContent($id) {
        
        $sourceClient = new Client();
        
        $courseResponse = $sourceClient->get('/courses/{id}', [
            'id' => $id
        ]);

        $courseBodyContent = $courseResponse
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
                $course = $this->getSourceCourseContent($courseId);
                
                $sourceApiXCourse = new SourceApiXCourse(
                    $course['id'],
                    $course['name'],
                    $course['grade']
                );
                $sourceApi->addCourse($sourceApiXCourse);
            }
            $courseList = $this->getSourceCourseListContent($courseList['next']);
        } while ($courseList['next'] !== '');
        
        $destinationCourses = $sourceApi->getDestinationCourses();
        $this->postToDestinationApi(1, $destinationCourses);
    }
    
    private function postToDestinationApi($schoolId, $destinationCourses) {
        $destinationClient = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://destination-service/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $destinationClient->post('/school/{schoolId}/courses', [
            'schoolId' => $schoolId,
            'json' => [
                'courses' => $destinationCourses
            ]
        ]);
    }
            
}
