<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends Repository
{
    // model property on class instances
    protected $article;

    // Constructor to bind model to repo
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->setModel($article);
    }

    // check if Title Existed except id
    public function isTitleExisted($title, $id = null)
    {
        return $this->article->isTitleExisted($title, $id);
    }


    // find all article made by user
    public function allByUserId($userId)
    {
        return $this->article->allByUserId($userId);
    }

    public function allByUserIdPaginate($userId,$amount)
    {
        return $this->article->allByUserIdPaginate($userId,$amount);
    }

    public function all()
    {
        return $this->article->allWithCache();
    }

    public function find($id)
    {
        return $this->article->findWithCache($id);
    }

    public function update(array $data, $id)
    {
        return $this->article->updateWithCache($data,$id);
    }

    public function delete($id)
    {
        return $this->model->deleteWithCache($id);
    }
}
