<?php
namespace Book\Controller;

interface IAction {
    /**
     * @return mixed
     */
    public function addAction();

    /**
     * @return mixed
     */
    public function editAction();

    /**
     * @return mixed
     */
    public function deleteAction();
}