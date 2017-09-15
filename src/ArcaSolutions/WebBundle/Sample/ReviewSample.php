<?php
namespace ArcaSolutions\WebBundle\Sample;

use ArcaSolutions\WebBundle\Entity\Review;

class ReviewSample extends Review
{

    /**
     * ReviewSample constructor.
     *
     * @param misc $translator
     * @param string $type
     */
    public function __construct($translator, $type = 'listing')
    {
        $this->setReviewTitle($translator->trans('Review Title'))
            ->setItemType($type)
            ->setReviewerName($translator->trans('Visitor'))
            ->setReviewerEmail('email@sample.com')
            ->setReviewerLocation('')
            ->setReview('Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.')
            ->setAdded(new \DateTime('now'))
            ->setRating(rand() % 6)
            ->setlike(rand() % 21)
            ->setDislike(rand() % 11)
            ->setProfile(new AccountprofilecontactSample($translator));
    }
}
