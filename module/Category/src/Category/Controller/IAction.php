<?php
namespace Category\Controller;

interface IAction {
    public function addAction();
    public function editAction();
    public function deleteAction();
}