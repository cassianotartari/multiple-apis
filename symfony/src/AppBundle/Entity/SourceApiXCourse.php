<?php


namespace AppBundle\Entity;

use AppBundle\Model\SourceApiCourseInterface;
use AppBundle\Entity\DestinationCourse;

/**
 * Description of SourceApiXCourse
 *
 * @author cassiano
 */
class SourceApiXCourse implements SourceApiCourseInterface
{
    /**
     * @var string
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $grade;
    
    public function __construct($id, $name, $grade)
    {
        $this->id = $id;
        $this->name = $name;
        $this->grade = $grade;
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;
        
        return $this;
    }
    
    public function getGradeNumber() {
        return GradeLevel::getGradeLevelNumber($this->grade);
    }

    public function castToDestinationCourse(): DestinationCourse
    {
        return new DestinationCourse(
            $this->name,
            $this->getGradeNumber(),
            $this->id
        );
    }

}
