<?php

namespace Category\Controller;

use Book\Controller\BookController;
use Category\Form\CategoryForm;
use Category\Model\Category;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController implements IAction
{
    protected $categoryTable;

    public function getCategoryTable()
    {
        if (!$this->categoryTable) {
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Category\Model\CategoryTable');
        }
        return $this->categoryTable;
    }

    public function indexAction()
    {
        $resultSet = $this->getCategoryTable()->getAllCategory();
        $listCategory = array();
        foreach ($resultSet as $row) {
            array_push($listCategory, get_object_vars($row));
        }
        return new ViewModel(array(
            'listCategory' => $listCategory,
        ));
    }

    /** redirect to home - show list category **/
    public function returnHome()
    {
        return $this->redirect()->toRoute(
            'category',
            array(
                'controller'    => 'Category\Controller\Category',
                'action'        => 'index'
            )
        );
    }

    /** add new category **/
    public function addAction()
    {
        $form = new CategoryForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        // if have request post -> create category -> come to Home, else redirect Add page
        if ($request->isPost()) {
            $category = new Category();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $category->exchangeArray($form->getData());
                $this->getCategoryTable()->addCategory($category);
                $this->returnHome();
            }
        }
        return new ViewModel(array('form' => $form));
    }

    /** Edit new category **/
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('category', array(
                'action' => 'add'
            ));
        }
        try {
            $category = $this->getCategoryTable()->getCategoryById($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('category', array(
                'action' => 'index'
            ));
        }

        $form  = new CategoryForm();
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        $form->bind($category);
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getCategoryTable()->addCategory($category);
                // Redirect to list of categorys
                return $this->redirect()->toRoute('category');
            }
        }

        return new ViewModel(array(
            'id'    => $id,
            'form'  => $form,
        ));
    }

    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->getCategoryTable()->deleteCategory($id);
        return $this->redirect()->toRoute(
            'book',
            array(
                'controller'    => 'Book\Controller\Book',
                'action'        => 'deleteByCategoryId',
                'id'            => $id
            )
        );
    }
}