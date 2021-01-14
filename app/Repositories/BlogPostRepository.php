<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;


/**
 * Class BlogPostRepository
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startCondition()
            ->select($columns)
            ->orderByDesc('id')
            //->with(['category','user'])
            ->with(['category' => function ($query) {
                return $query->select(['id', 'title']);
            },
                'user:id,name'
            ])
            ->paginate(25);

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }
}
