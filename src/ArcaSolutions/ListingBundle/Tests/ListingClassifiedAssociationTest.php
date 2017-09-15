<?php

namespace ArcaSolutions\ListingBundle\Tests;

use ArcaSolutions\ListingBundle\Entity\Listing;

final class ListingClassifiedAssociationTest extends \PHPUnit_Framework_TestCase
{
    private $classifiedFieldRelationship = 'classifieds';
    private $listingEntity;

    public function setUp()
    {
        $this->listingEntity = new Listing();
    }

    public function tearDown()
    {
        $this->listingEntity = null;
    }

    public function testListingClassifiedRelationship()
    {
        $this->assertObjectHasAttribute(
            $this->classifiedFieldRelationship,
            $this->listingEntity,
            'Listing entity does not have classified variable for relationship'
        );
    }
}
