<?php

namespace URM\First\Block;


use URM\First\Model\ResourceModel\Assignment\Collection;
use Magento\Framework\View\Element\Template;

class First extends Template
{
    private $collection;

    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }


    public function getAllFormData()
    {
        return $this->collection;
    }

    public function getFirst()
    {
        return'Hello WORLD!';
    }}

