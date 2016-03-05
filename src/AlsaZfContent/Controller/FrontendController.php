<?php
namespace AlsaZfContent\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class FrontendController extends AbstractActionController
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
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        return $this->notFoundAction();
    }
    
    /**
     * Displays a single content.
     */
    public function viewAction()
    {
        // Get content
        $id = $this->params()->fromRoute('id');
        $content = $this->contentService->getContent($id);
        if (false == $content || 0 == $content->getContentStatus()) {
            return $this->notFoundAction();
        }
        
        // View
        return compact('content');
    }
}
