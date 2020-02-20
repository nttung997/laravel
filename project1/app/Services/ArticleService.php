<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use App\Services\UserService;

class ArticleService extends Service
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository, UserService $userService)
    {
        $this->articleRepository = $articleRepository;
        $this->userService = $userService;
        $this->setRepository($articleRepository);
    }

    // return article which have given id
    // return false if no article
    // or user dont own article
    public function find($id, $userId = null)
    {
        $article = parent::find($id);
        if (!$article) return false;
        if ($userId && !$this->isYour($userId, $article)) return false;
        return $article;
    }

    // create and return article
    // return false if title already exists
    // or cannot create article
    public function create($data)
    {
        if (!$this->checkTitle($data)) return false;
        $article = parent::create($data);
        return $article;
    }

    // update and return 1
    // return false if article doesnt exist
    // or user dont own article
    // or title already exists
    public function update($data, $id, $userId = null)
    {
        $article = $this->find($id,$userId);
        if(!$article) return false;
        if (!$this->checkTitle($data,$id)) return false; 
        $respond = $this->articleRepository->update($data, $id);
        return $respond;
    }

    public function delete($id, $userId = null)
    {
        $article = $this->find($id,$userId);
        if(!$article) return false;
        $respond = parent::delete($id);
        return $respond;
    }

    public function allByUserId($userId)
    {
        return $this->articleRepository->allByUserId($userId);
    }
    public function allByUserIdPaginate($userId, $amount)
    {
        return $this->articleRepository->allByUserIdPaginate($userId, $amount);
    }

    public function isYour($userId, $article)
    {
        if ($userId != $article->user_id) {
            $this->add_error('This article is not your');
            return false;
        }
        return true;
    }
    public function checkTitle($data, $id = null)
    {
        if ($this->articleRepository->isTitleExisted($data['title'], $id)) {
            $this->add_error('Title existed');
            return false;
        }
        return true;
    }
}
