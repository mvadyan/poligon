<?php


namespace App\Repositories;


use App\Models\BlogCategory as Model;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }

    /**
     * @return mixed
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS view_title'
        ]);

        $result = $this->startCondition()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * @param int|null $perPage
     * @return mixed
     */
    public function getAllWithPaginate(int $perPage = null)
    {
        $fields = ['id', 'title', 'parent_id'];

        $result = $this->startCondition()
            ->select($fields)
            ->paginate($perPage);

        return $result;
    }

}
