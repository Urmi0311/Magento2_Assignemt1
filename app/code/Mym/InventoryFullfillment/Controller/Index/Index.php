<?php

namespace Mym\InventoryFullfillment\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private PageFactory $pageFactory
    ) {
    }

    /**
     * @return Page
     */
    public function execute() : Page
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__("Hello Word!!!"));

        return $page;
    }
}
