<?php

namespace Book\Controller;

use Book\Form\BookForm;
use Book\Model\Book;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class BookController extends AbstractActionController implements IAction
{
    protected $bookTable;

    /**
     * @return array|object
     */
    public function getBookTable()
    {
        if (!$this->bookTable) {
            $sm = $this->getServiceLocator();
            $this->bookTable = $sm->get('Book\Model\BookTable');
        }
        return $this->bookTable;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $currentPage = (int)$this->params()->fromRoute('page', 1);
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $table = new TableGateway('book', $adapter);
        $query = $table->select(function (Select $select) {
            $select->join('category', 'book.category = category.id');
        });
        $listBook = array();

        $iteratorAdapter = new paginatorIterator($query);
        $page = new Paginator($iteratorAdapter);
        $page->setItemCountPerPage(10);
        $page->setCurrentPageNumber($currentPage);

        foreach ($page as $row) {
            array_push($listBook, $row);
        }

        return new ViewModel(
            array(
                'listBook' => $listBook,
                'totalPage' => $page->count(),
                'currentPage' => $currentPage
            )
        );
    }

    /** add new book **/
    public function addAction()
    {
        $form = new BookForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $book = new Book();
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $book->exchangeArray($form->getData());
                $this->getBookTable()->addBook($book);
                return $this->redirect()->toRoute('book');
            }
        }

        return new ViewModel(
            array(
                'form' => $form,
                'listCategory' => $this->getListCategory()
            )
        );
    }

    /** Edit new book **/
    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'add'
            ));
        }
        try {
            $book = $this->getBookTable()->getBookById($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'index'
            ));
        }

        $form = new BookForm();
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        $form->bind($book);
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getBookTable()->addBook($book);
                return $this->redirect()->toRoute('book');
            }
        }

        return new ViewModel(array(
            'id' => $id,
            'form' => $form,
            'listCategory' => $this->getListCategory(),
            'categoryId' => $book->category
        ));
    }

    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->getBookTable()->deleteBook($id);
        return $this->redirect()->toRoute('book');
    }

    public function deleteByCategoryIdAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->getBookTable()->deleteBookByCategoryId($id);
        return $this->redirect()->toRoute('category');
    }

    /**
     * @return array
     */
    public function getListCategory()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tableCategory = new TableGateway('category', $adapter);
        $queryGetListCategory = $tableCategory->select();
        $listCategory = array();

        foreach ($queryGetListCategory as $row) {
            $listCategory[$row->id] = $row->description;
        }

        return $listCategory;
    }
}