<?php
namespace AlsaZfContent\Service;

use Zend\EventManager\EventManagerAwareTrait;
use Zend\Hydrator\HydratorInterface;
use Zend\Http\PhpEnvironment\Request;

class ContentService
{
    use EventManagerAwareTrait;
    
    /**
     * @var \AlsaZfContent\Form\ContentForm
     */
    protected $contentForm;
    
    /**
     * @var HydratorInterface
     */
    protected $contentModelHydrator;
    
    /**
     * @var \AlsaZfContent\Model\ContentTable 
     */
    protected $contentTable;
    
    /**
     * @var \Zend\Mvc\Controller\PluginManager
     */
    protected $controllerPluginManager;
    
    /**
     * @var Request
     */
    protected $request;
    
    public function __construct(\AlsaZfContent\Model\ContentTable $contentTable,
                                \AlsaZfContent\Form\ContentForm $contentForm,
                                \Zend\Mvc\Controller\PluginManager $controllerPluginManager,
                                HydratorInterface $contentModelHydrator,
                                Request $request)
    {
        $this->contentTable = $contentTable;
        $this->contentForm = $contentForm;
        $this->controllerPluginManager = $controllerPluginManager;
        $this->contentModelHydrator = $contentModelHydrator;
        $this->request = $request;
    }
    
    public function deleteContent(\AlsaZfContent\Entity\Content $content)
    {
        $args = $this->getEventManager()->prepareArgs(compact('content'));
        $this->getEventManager()->trigger('delete.pre', $this, $args);
        $return = $this->contentTable->delete(['content_id' => $content->getContentId()]);
        $this->getEventManager()->trigger('delete.post', $this, $args);
        return $return;
    }
    
    public function getContent($id)
    {
        return $this->contentTable->fetchRowById($id);
    }
    
    public function getContentForm()
    {
        return $this->contentForm;
    }
    
    public function getContents()
    {
        return $this->contentTable->fetchRowset();
    }
    
    public function processContentForm(\AlsaZfContent\Form\ContentForm $form)
    {
        $prg = $this->controllerPluginManager->get('prg')->__invoke();
        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            return $prg;
        } elseif (true === is_array($prg)) {
            $form->setData($prg);
            if (true === $form->isValid()) {
                $content = $form->getData();
                $this->saveContent($content, $prg);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Processes the form for confirming a deleteion.
     * 
     * @param \AlsaZfContent\Entity\Content $content
     * @return boolean
     */
    public function processContentDeleteForm(\AlsaZfContent\Entity\Content $content)
    {
        if (true === $this->request->isPost() && null != $this->request->getPost('delete')) {
            $this->deleteContent($content);
            return true;
        }
        
        return false;
    }
    
    public function saveContent(\AlsaZfContent\Entity\Content $content, $prg = [])
    {
        $data = $this->contentModelHydrator->extract($content);
        $args = $this->getEventManager()->prepareArgs(compact('data', 'prg', 'content'));
        
        $this->getEventManager()->trigger('save.pre', $this, $args);
        if (null == $content->getContentId()) {
            $this->getEventManager()->trigger('insert.pre', $this, $args);
            $this->contentTable->insert($args['data']);
            $content->setContentId($this->contentTable->getLastInsertValue());
            $this->getEventManager()->trigger('insert.post', $this, $args);
        } else {
            $this->getEventManager()->trigger('update.pre', $this, $args);
            $this->contentTable->update($args['data'], ['content_id' => $content->getContentId()]);
            $this->getEventManager()->trigger('update.post', $this, $args);
        }
        $this->getEventManager()->trigger('save.post', $this, $args);
    }
}

