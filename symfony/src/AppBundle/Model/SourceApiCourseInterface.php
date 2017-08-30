<?php

namespace AppBundle\Model;

use AppBundle\Entity\DestinationCourse;

/**
 * Description of SourceApiInterface
 *
 * @author cassiano
 */
interface SourceApiCourseInterface
{
    /**
     * @return DestinationCourse
     */
    public function castToDestinationCourse();
}
