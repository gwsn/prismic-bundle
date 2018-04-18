<?php
namespace Gwsn\PrismicBundle\Services;

use Gwsn\Prismic\Document\BasePrismicDocument;

class PrismicConnector
{

    /**
     * @var
     */
    protected $prismic;

    public function __construct() {
        $prismic = new BasePrismicDocument();
        $source = $prismic->getDocumentByType('blog-post');
    }


}