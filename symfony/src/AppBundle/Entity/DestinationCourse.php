<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

/**
 * Description of DestinationCourse
 *
 * @author cassiano
 */
class DestinationCourse
{
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var integer
     */
    private $grade;
    
    /**
     * @var string
     */
    private $srcid;
    
    function getTitle()
    {
        return $this->title;
    }

    function getGrade()
    {
        return $this->grade;
    }

    function getSrcid()
    {
        return $this->srcid;
    }

    function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }

    function setGrade($grade)
    {
        $this->grade = $grade;
        
        return $this;
    }

    function setSrcid($srcid)
    {
        $this->srcid = $srcid;
        
        return $this;
    }

    function __construct($title, $grade, $srcid)
    {
        $this->title = $title;
        $this->grade = $grade;
        $this->srcid = $srcid;
    }

        
}
