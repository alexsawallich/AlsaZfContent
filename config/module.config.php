<?php
return [
    'controllers' => [
        'factories' => [
            '\AlsaZfContent\Controller\Backend' => \AlsaZfContent\Controller\BackendControllerFactory::class,
            '\AlsaZfContent\Controller\Frontend' => \AlsaZfContent\Controller\FrontendControllerFactory::class
        ]
    ],
    'form_elements' => [
        'factories' => [
            'AlsaZfContent\Form' => \AlsaZfContent\Form\ContentFormFactory::class,
        ]
    ],
    'input_filters' => [
        'factories' => [
            'AlsaZfContent\InputFilter' => \AlsaZfContent\Form\ContentFormFilterFactory::class,
        ]
    ],
    'navigation' => [
        'admin' => [
            'alsazfcontent' => [
                'label' => 'Content',
                'route' => 'zfcadmin/alsazfcontent'
            ]
        ]
    ],
    'router' => [
        'routes' => [
            'alsazfcontent' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/content/:id/',
                    'defaults' => [
                        '__NAMESPACE__' => '\AlsaZfContent\Controller',
                        'controller' => 'Frontend',
                        'action' => 'view'
                    ],
                    'constraints' => [
                        'id' => '\d+'
                    ]
                ]
            ],
            'zfcadmin' => [
                'child_routes' => [
                    'alsazfcontent' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/content[/:action[/:id]]/',
                            'defaults' => [
                                '__NAMESPACE__' => '\AlsaZfContent\Controller',
                                'controller' => 'Backend',
                                'action' => 'index'
                            ],
                            'constraints' => [
                                'id' => '\d+',
                                'action' => '(edit|delete|add)'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            'AlsaZfContent\Table' => \AlsaZfContent\Model\ContentTableFactory::class,
            'AlsaZfContent\Service' =>  \AlsaZfContent\Service\ContentServiceFactory::class,
            'AlsaZfContent\Model\Hydrator' => \AlsaZfContent\Model\ContentHydratorFactory::class,
            'AlsaZfContent\Form\Hydrator' => \AlsaZfContent\Form\ContentHydratorFactory::class,
            'AlsaZfContent\Options' => \AlsaZfContent\Options\ContentOptionsFactory::class,
        ]
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../languages',
                'pattern' => '%s.php',
                'text_domain' => 'alsazfcontent'
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'AlsaZfContent' => __DIR__ . '/../view',
        ],
    ],
    'alsazfcontent' => [
        'content_entity_name' => \AlsaZfContent\Entity\Content::class,
        'content_table_name' => 'content',
        'content_table_adapter_name' => '\Zend\Db\Adapter\Adapter',
    ]
];
