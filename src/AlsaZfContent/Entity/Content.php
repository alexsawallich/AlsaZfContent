<?php
namespace AlsaZfContent\Entity;

class Content
{
    protected $content_id;
    
    protected $content_body;
    
    protected $content_name;
    
    protected $content_status;
    
    public function getContentId()
    {
        return $this->content_id;
    }
    
    public function setContentId($id)
    {
        $this->content_id = $id;
        return $this;
    }
    
    public function getContentBody()
    {
        return $this->content_body;
    }
    
    public function setContentBody($body)
    {
        $this->content_body = $body;
        return $this;
    }
    
    public function getContentName()
    {
        return $this->content_name;
    }
    
    public function setContentName($name)
    {
        $this->content_name = $name;
        return $this;
    }
    
    public function getContentStatus()
    {
        return $this->content_status;
    }
    
    public function setContentStatus($status)
    {
        $this->content_status = $status;
        return $this;
    }
    
    
}
