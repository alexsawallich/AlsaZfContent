<?php
namespace AlsaZfContent\Model;

use AlsaBase\Db\AbstractTableGateway;

class ContentTable extends AbstractTableGateway
{
    public function fetchRowById($id)
    {
        $select = $this->getSelect();
        $select->where->and->equalTo($this->table.'.content_id', (int)$id);
        return $this->selectWith($select)->current();
    }
}
