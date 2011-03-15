<?php 

namespace Funsational\CommonBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;

/**
 * @mongodb:Document
 */
class User extends BaseUser
{
    /** @mongodb:Id(strategy="auto") */
    protected $id;

    /** @mongodb:ReferenceMany(targetDocument="FOS\UserBundle\Document\Group") */
    protected $groups;
}
