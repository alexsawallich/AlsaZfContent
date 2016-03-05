# Simplest Content Management with AlsaZfContent
AlsaZfContent is a very simple content module for your Zend-Framework >= 2 application.

It ships with a backend for creating, editing and deleting content-items (requires ZfcAdmin for the backend-routes).
A content-item is a very simple entity, consisting only of a name, a text-body and a publishing-status.
The only task of the frontend is to display a content-item on a single-page, with it's name and text-body.

## Dependencies
* This module requires [ZfcAdmin](https://github.com/ZF-Commons/ZfcAdmin), since it uses the `zfcadmin`-route for the backend.
* This module depends on [AlsaBase](https://github.com/alexsawallich/AlsaBase) as it uses some of the abstract classes, which can be found there.

*These dependencies will be installed by composer.*

## Installation
1. Install through composer `require alexsawallich/alsazfcontent`

2. Add `AlsaZfContent` to the `modules`-key within your application's `config/application.config.php`-file.

3. Copy `config/alsazfcontent.global.php.dist` to your application's `config/autoload/alsazfcontent.global.php` and adjust to your needs.

## Configuration
Adjust configuration of this module to your needs.

	<?php
	return [
	    'alsazfcontent' => [
	        /**
	         * Name of the class you want to use for content-entities. If you use your
	         * own enhanced entity-classes they must extend \AlsaZfCotnent\Entity\Content.
	         * 
	         * default: '\AlsaZfContent\Entity\Content'
	         * 
	         * @var string
	         */
	        'content_entity_name' => \AlsaZfContent\Entity\Content::class,
	        
	        /**
	         * Name of the database-table, where the contents should be stored.
	         * 
	         * default: content
	         * 
	         * @var string
	         */
	        'content_table_name' => 'content',
	        
	        /**
	         * Key of the db-adapter within the service-manager.
	         * 
	         * default: \Zend\Db\Adapter\Adapter
	         * 
	         * @var string
	         */
	        'content_table_adapter_name' => '\Zend\Db\Adapter\Adapter',
	    ]
	];

## Misc.

### Styling
Like the [Skeleton Application](https://github.com/zendframework/ZendSkeletonApplication) this module uses
[Twitter Bootstrap](http://getbootstrap.com/) for styling. If you don't use Twitter Bootstrap in your application
you will probably at least want to overwrite the frontend template to add your own CSS-classes and such.

Therefore you will have to overwrite `view/alsa-zf-content/controller/frontend/view.phtml`

### Translation
The module uses english as its' major language. However wherever a string is displayed to the user ZFs transaltion-features
are taken into account, since the `translate`-view-helper is used within the views. Flashmessages are also translated within the
controllers as are form labels. Therefore you need to have a `translator`-key setup within your application's configuration-file. The text-domain for
this module is `alsazfcontent`. Currently only a german translation is available. You may feel free, to translate this module into your
native language and make a pull request.

## Enhancement
To enhance functionality you will have to write your own modules, which interact with AlsaZfContent. Therefore
AlsZfContent triggers events at particular places, which allow you to hook up with your own module.