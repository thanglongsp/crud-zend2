<?php
namespace Category\Model;

use Book\Controller\BookController;
use Category\Repository\ICategoryRepository;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

class CategoryTable implements ICategoryRepository
{
    protected $tableGateway;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAllCategory()
    {
        return $this->tableGateway->select();
    }

    public function getCategoryById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function addCategory(Category $category)
    {
        $data = array(
            'description' => $category->description,
        );
        $id = (int)$category->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCategoryById($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Category id does not exist');
            }
        }
    }

    public function deleteCategory($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}