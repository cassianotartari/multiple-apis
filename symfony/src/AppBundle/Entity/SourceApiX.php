<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Model\SourceApiInterface;
use AppBundle\Entity\SourceApiXCourse;
use AppBundle\Entity\GradeLevel;

/**
 * SourceApiX
 *
 * @ORM\Table(name="source_api_x")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SourceApiXRepository")
 */
class SourceApiX implements SourceApiInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     */
    private $baseUri;

    /**
     *
     * @var SourceApiXCourse[]
     */
    private $courses;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCourses(): array
    {
        return $this->courses;
    }
    
    public function __construct()
    {
        $this->courses = [];
    }
    
    public function addCourse(SourceApiXCourse $course)
    {
        $this->courses[] = $course;
        
        return $this;
    }

    function getBaseUri()
    {
        return $this->baseUri;
    }

    function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
        
        return $this;
    }

    public function getDestinationCourses(): array
    {
        $destinationCourses = array();
        foreach ($this->courses as $course) {
            $destinationCourses[] = $course->castToDestinationCourse();
        }
        return $destinationCourses;
    }

}

