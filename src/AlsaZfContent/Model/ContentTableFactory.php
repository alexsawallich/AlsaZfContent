<?php
namespace AlsaZfContent\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\HydratingResultSet;

class ContentTableFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('AlsaZfContent\Options');
        
        $adapter = $serviceLocator->get($options->getContentTableAdapterName());
        $table = $options->getContentTableName();
        
        $entityName = $serviceLocator->get('AlsaZfContent\Options')->getContentEntityName();
        $entity = new $entityName();
        
        $hydrator = $serviceLocator->get('AlsaZfContent\Model\Hydrator');
        $resultSetPrototype = new HydratingResultSet($hydrator, $entity);
        
        return new ContentTable($table, $adapter, null, $resultSetPrototype);
    }
}
