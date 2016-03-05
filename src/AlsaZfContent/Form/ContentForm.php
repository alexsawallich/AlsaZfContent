<?php
namespace AlsaZfContent\Form;

use AlsaBase\Form\EventManagerAwareForm;

class ContentForm extends EventManagerAwareForm
{
    /**
     * (non-PHPdoc)
     * @see \Zend\Form\Element::init()
     */
    public function init()
    {
        $this->add([
            'name' => 'content_name',
            'type' => 'Text',
            'options' => [
                'label' => 'Name'
            ]
        ]);
        
        $this->add([
            'name' => 'content_body',
            'type' => 'Textarea',
            'options' => [
                'label' => 'Body'
            ]
        ]);
        
        $this->add([
            'name' => 'content_status',
            'type' => 'Radio',
            'options' => [
                'label' => 'Status',
                'value_options' => [
                    0 => 'Unpublished',
                    1 => 'Published'
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'options' => [
                'label' => 'Save'
            ]
        ]);
        
        $this->getEventManager()->trigger('init', $this);
    }
}
