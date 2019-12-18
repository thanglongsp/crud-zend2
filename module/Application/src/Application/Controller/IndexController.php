<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $resultSet = $this->getBookTable()->fetchAll();
        $listBook = array();
        foreach ($resultSet as $row) {
            array_push($listBook, $row);
        }

        return new ViewModel(array(
            'listBook' => $listBook,
        ));
    }
}
