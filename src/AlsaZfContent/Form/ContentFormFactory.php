<?php
namespace AlsaZfContent\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentFormFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        $serviceLocator = $formElementManager->getServiceLocator();
        
        $form = new ContentForm();
        
        $hydrator = $serviceLocator->get('AlsaZfContent\Form\Hydrator');
        $form->setHydrator($hydrator);
        
        $inputFilter = $serviceLocator->get('inputfiltermanager')->get('AlsaZfContent\InputFilter');
        $form->setInputFilter($inputFilter);
        
        $entity = $serviceLocator->get('AlsaZfContent\Table')->getResultSetPrototype()->getObjectPrototype();
        $form->bind($entity);
        
        return $form;
    }
}
