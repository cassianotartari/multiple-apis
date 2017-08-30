<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

/**
 * Description of GradeLevel
 *
 * @author cassiano
 */
class GradeLevel
{
    /**
     * Freshmen level (9th grade)
     */
    const FR = "FR";
    
    /**
     * Sophomore level (10th grade)
     */
    const SPH = "SPH";
    
    /**
     * Sophomore level (11th grade)
     */
    const JR = "JR";
    
    /**
     * Senior level (12th grade)
     */
    const SR = "SR";
    
    const GRADE9 = 9;
    const GRADE10 = 9;
    const GRADE11 = 9;
    const GRADE12 = 9;
    
    public static function getGradeLevelNumber($gradeLevelTxt) 
    {
        $map = [
            self::FR => self::GRADE9,
            self::SPH => self::GRADE10,
            self::JR => self::GRADE11,
            self::SR => self::GRADE12,
        ];
        
        return isset($map[$gradeLevelTxt])?$map[$gradeLevelTxt]:NULL;
    }

}
