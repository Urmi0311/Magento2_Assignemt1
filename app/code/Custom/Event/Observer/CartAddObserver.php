<?php

namespace Custom\Event\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class CartAddObserver implements ObserverInterface
{
    protected $transportBuilder;
    protected $storeManager;
    protected $logger;

    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $cart = $observer->getEvent()->getCart();
        $customerId = $cart->getCustomer()->getId();
        $itemsCount = $cart->getItemsCount();

        $this->logger->debug('CartAddObserver executing with customerId: ' . $customerId . ' and itemsCount: ' . $itemsCount);

        if ($customerId && $itemsCount > 5) {
            $customerEmail = $cart->getCustomer()->getEmail();
            $customerName = $cart->getCustomer()->getName();
            $storeId = $cart->getStoreId();
            $store = $this->storeManager->getStore($storeId);
            $templateVars = [
                'customer_name' => $customerName,
                'items_count' => $itemsCount
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('New Order')
                ->setTemplateOptions([
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $storeId,
                ])
                ->setTemplateVars($templateVars)
                ->setFrom('general')
                ->addTo($customerEmail, $customerName)
                ->getTransport();

            $this->logger->debug('Sending email to ' . $customerEmail . ' with templateVars: ' . print_r($templateVars, true));

            try {
                $transport->sendMessage();
            } catch (\Exception $e) {
                $this->logger->error('Error sending email: ' . $e->getMessage());
            }
        }
    }
}
