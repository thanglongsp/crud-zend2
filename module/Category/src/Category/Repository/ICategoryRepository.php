<?php
namespace Category\Repository;
use Category\Model\Category;

interface ICategoryRepository {
    public function getAllCategory();
    public function getCategoryById($id);
    public function addCategory(Category $category);
    public function deleteCategory($id);
}