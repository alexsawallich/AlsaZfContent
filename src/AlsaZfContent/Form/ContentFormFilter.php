<?php
namespace AlsaZfContent\Form;

use AlsaBase\InputFilter\EventManagerAwareInputFilter;

class ContentFormFilter extends EventManagerAwareInputFilter
{
    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\BaseInputFilter::init()
     */
    public function init()
    {
        $this->add([
            'name' => 'content_name',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StringTrim'
                ],
                [
                    'name' => 'StripTags'
                ]
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 2,
                        'max' => 255
                    ]
                ]
            ]
        ]);
        
        $this->getEventManager()->trigger('init', $this);
    }
}
