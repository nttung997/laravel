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

    public function allByUserIdPaginate($userId, $amount)
    {
        return $this->article->allByUserIdPaginate($userId, $amount);
    }

    public function all()
    {
        if (env('CACHE_ENABLE', false)) {
            $objects = null;
            $key = Article::MODEL . '_all';
            if ($this->checkCache($key)) //get object from cache
            {
                $objects = $this->getCache($key);
            } else { //get object and cache 
                $objects = parent::all();
                if ($objects) $this->setCache($key, $objects);
            }
            return $objects;
        }
        return parent::all();
    }

    public function find($id)
    {
        if (env('CACHE_ENABLE', false)) {
            $key = Article::MODEL . '_find_' . $id;
            if ($this->checkCache($key)) {
                $object = $this->getCache($key);
            } else {
                $object = parent::find($id);
                if ($object) $this->setCache($key, $object);
            }
            return $object;
        }
        return parent::find($id);
    }

    public function update(array $data, $id)
    {
        if (env('CACHE_ENABLE', false)) {
            $result = parent::update($data, $id);
            if ($result) {
                $key = Article::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return parent::update($data, $id);
    }

    public function delete($id)
    {
        if (env('CACHE_ENABLE',false)) {
            $result = parent::delete($id);
            if ($result) {
                $key = Article::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return parent::delete($id);    }
}
