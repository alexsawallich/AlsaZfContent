<?php
namespace AlsaZfContent\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentServiceFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $contentForm = $serviceLocator->get('formelementmanager')->get('AlsaZfContent\Form');
        $contentTable = $serviceLocator->get('AlsaZfContent\Table');
        $contentModelHydrator = $serviceLocator->get('AlsaZfContent\Model\Hydrator');
        $prg = $serviceLocator->get('controllerpluginmanager');
        $request = $serviceLocator->get('request');
        return new ContentService($contentTable, $contentForm, $prg, $contentModelHydrator, $request);
    }
}
