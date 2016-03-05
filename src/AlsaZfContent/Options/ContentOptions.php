<?php
namespace AlsaZfContent\Options;

use Zend\Stdlib\AbstractOptions;

class ContentOptions extends AbstractOptions
{
    protected $content_table_name;
    
    protected $content_table_adapter_name;
    
    protected $content_entity_name;
    
    public function getContentTableName()
    {
        return $this->content_table_name;
    }
    
    public function setContentTableName($name)
    {
        $this->content_table_name = $name;
        return $this;
    }
    
    public function getContentTableAdapterName()
    {
        return $this->content_table_adapter_name;
    }
    
    public function setContentTableAdapterName($name)
    {
        $this->content_table_adapter_name = $name;
        return $this;
    }
    
    public function getContentEntityName()
    {
        return $this->content_entity_name;
    }
    
    public function setContentEntityName($name)
    {
        $this->content_entity_name = $name;
        return $this;
    }
}
