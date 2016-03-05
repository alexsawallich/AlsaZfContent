<?php
namespace AlsaZfContent\Controller;

use AlsaBase\Controller\AbstractActionController;
use AlsaZfContent\Entity\Content;

class BackendController extends AbstractActionController
{
    /**
     * @var \AlsaZfContent\Service\ContentService
     */
    protected $contentService;
    
    function __construct(\AlsaZfContent\Service\ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    
    /**
     * Allows to add a content.
     */
    public function addAction()
    {
        // Form
        $form = $this->contentService->getContentForm();
        $form->bind(new Content());
        
        // Processing
        $process = $this->contentService->processContentForm($form);
        if ($process instanceof \Zend\Http\PhpEnvironment\Response) {
            return $process;
        } elseif (true == $process) {
            $this->flashmessenger()->addSuccessMessage($this->translate('The content has been created successfully.', 'alsazfcontent'));
            return $this->redirect()->toRoute('zfcadmin/alsazfcontent');
        }
        
        // View
        return compact('form');
    }
    
    /**
     * Allows to delete a content.
     */
    public function deleteAction()
    {
        // Get Content
        $id = $this->params()->fromRoute('id');
        $content = $this->contentService->getContent($id);
        if (false === $content) {
            return $this->notFoundAction();
        }
        
        // Processing
        $process = $this->contentService->processContentDeleteForm($content);
        if (true === $process) {
            $this->flashmessenger()->addSuccessMessage($this->translate('The content has successfully been deleted.', 'alsazfcontent'));
            return $this->redirect()->toRoute('zfcadmin/alsazfcontent');
        }
        
        // View
        return compact('content');
    }
    
    /**
     * Allows to edit a content.
     */
    public function editAction()
    {
        // Get Content
        $id = $this->params()->fromRoute('id');
        $content = $this->contentService->getContent($id);
        if (false === $content) {
            return $this->notFoundAction();
        }
        
        // Form
        $form = $this->contentService->getContentForm();
        $form->bind($content);
        
        // Processing
        $process = $this->contentService->processContentForm($form);
        if ($process instanceof \Zend\Http\PhpEnvironment\Response) {
            return $process;
        } elseif (true == $process) {
            $this->flashmessenger()->addSuccessMessage($this->translate('The content has been changed successfully.', 'alsazfcontent'));
            return $this->redirect()->toRoute('zfcadmin/alsazfcontent');
        }
        
        // View
        return compact('form', 'content');
    }
    
    /**
     * Lists all contents.
     */
    public function indexAction()
    {
        // Get all contents
        $contents = $this->contentService->getContents();
        
        // View
        return compact('contents');
    }
}

