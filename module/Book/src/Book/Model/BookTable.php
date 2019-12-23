<?php
namespace Book\Model;

use Book\Repository\IBookRepository;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

class BookTable implements IBookRepository
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function getAllBook()
    {
        return $this->tableGateway->select();
    }

    /**
     * @param $id int
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function getBookById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('book_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function addBook(Book $book)
    {
        $data = array(
            'category' => $book->category,
            'title' => $book->title,
        );
        $id = (int)$book->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBookById($id)) {
                $this->tableGateway->update($data, array('book_id' => $id));
            } else {
                throw new \Exception('Book id does not exist');
            }
        }
    }

    public function deleteBook($id)
    {
        $this->tableGateway->delete(array('book_id' => (int) $id));
    }

    public function deleteBookByCategoryId($categoryId)
    {
        $where = new Where();
        $where->like('category', $categoryId );
        return $this->tableGateway->delete($where);
    }
}