<?php

namespace ArcaSolutions\ClassifiedBundle\Tests;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;

final class ClassifiedListingAssociationTest extends \PHPUnit_Framework_TestCase
{
    private $fieldName = 'listingId';
    private $relationshipName = 'listing';
    private $classifiedEntity;

    public function setUp()
    {
        $this->classifiedEntity = new Classified();
    }

    public function tearDown()
    {
        $this->classifiedEntity = null;
    }

    public function testEntityHasListingRelationship()
    {
        $this->assertObjectHasAttribute(
            $this->fieldName,
            $this->classifiedEntity,
            'Classified entity does not have listing_id field'
        );

        $this->assertObjectHasAttribute(
            $this->relationshipName,
            $this->classifiedEntity,
            'Classified entity does not have listing variable for relationship'
        );
    }
}
