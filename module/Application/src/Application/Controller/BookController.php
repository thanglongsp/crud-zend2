<?php

namespace Application\Controller;

use Application\Form\BookForm;
use Application\Model\Book;
use Zend\View\Model\ViewModel;

class BookController extends BaseController
{
    public function returnHome()
    {
        return $this->redirect()->toRoute(
            'home',
            array(
                'controller'    => 'Application\Controller\Index',
                'action'        => 'index'
            )
        );
    }

    public function addAction()
    {
        $form = new BookForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Book();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getBookTable()->saveBook($album);
                // Redirect to list of albums
                $this->returnHome();
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function updateAction()
    {
        $book = new Book();
        $book->id = 2;
        $book->artist = "thanglong3";
        $book->title = "title3";
        $this->getBookTable()->saveBook($book);
        return new ViewModel();
    }

    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->getBookTable()->deleteBook($id);
        $this->returnHome();
    }
}