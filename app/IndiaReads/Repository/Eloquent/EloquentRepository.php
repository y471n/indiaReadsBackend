<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 23/07/15
 * Time: 6:11 PM
 */

namespace App\IndiaReads\Repository\Eloquent;

use App\IndiaReads\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


/**
 * Class EloquentRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
abstract class EloquentRepository implements BaseRepositoryInterface {

    /**
     * @var Model
     */
    protected $model;

     /**
     * Retrieve all data of repository
     *
     * @param array $columns
     * @return mixed
     */
    public function all()
    {
        $this->model = $this->model->all();
        return $this;
    }

    /**
     * Retrieve all data of repository, paginated
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = array('*'))
    {
        $results = $this->model->paginate($limit, $columns);
        return $results;
    }

   /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->model = $this->model->find($id);
        return $this;
    }

    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = array('*'))
    {
        $this->model = $this->model->where($field, $value);
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findFirstByField($field, $value, $columns = array('*'))
    {
        $this->model = $this->model->where($field, $value)->first();
        return $this;
    }

     /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = array('*'))
    {
        foreach ($where as $field => $value) {
            if ( is_array($value) ) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field,$condition,$val);
            } else {
                $this->model = $this->model->where($field,'=',$value);
            }
        }

        return $this;
    }


    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findMultipleWhere(array $where, $columns = array('*'))
    {
        foreach ($where as $field => $value) {
            if ( is_array($value) ) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field,$condition,$val);
            } else {
                $this->model = $this->model->where($field,'=',$value);
            }
        }
        return $this;
    }

    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findMultipleOrWhere(array $where)
    {
        $index = 0;
        foreach ($where as $field => $value) {
            if ( is_array($value) ) {
                list($field, $condition, $val) = $value;
                if($index == 0) {
                    $this->model = $this->model->where($field,$condition,$val);
                } else {
                    $this->model = $this->model->orWhere($field,$condition,$val);
                }
            } else {
                if($index == 0) {
                    $this->model = $this->model->where($field,'=',$value);
                } else {
                    $this->model = $this->model->orWhere($field,'=',$value);
                }
            }
            $index += 1;
        }

        return $this;
    }

    public function findMultipleWhereIn($field, array $values)
    {
        $this->model = $this->model->whereIn($field, $values);
        return $this;
    }

    public function getData($columns  = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $id = $this->model->create($attributes);
        return $id;
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $where, array $data)
    {
         foreach ($where as $field => $value) {
            if ( is_array($value) ) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field,$condition,$val);
            } else {
                $this->model = $this->model->where($field,'=',$value);
            }
        }
        return $this->model->update($data);
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $this->model = $this->find($id);
        $this->model->delete();
    }

    /**
     * Load relations
     *
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {
        // TODO: Implement with() method.
    }

    /**
     *
     */
    public function order($field, $value)
    {
        $this->model = $this->model->orderBy($field, $value);
        return $this;
    }

    /**
     * Set hidden fields
     *
     * @param array $fields
     * @return $this
     */
    public function hidden(array $fields)
    {
        // TODO: Implement hidden() method.
    }

    /**
     * Set visible fields
     *
     * @param array $fields
     * @return $this
     */
    public function visible(array $fields)
    {
        // TODO: Implement visible() method.
    }

    /**
     * Query Scope
     *
     * @param \Closure $scope
     * @return $this
     */
    public function scopeQuery(\Closure $scope)
    {
        // TODO: Implement scopeQuery() method.
    }

    /**
     * Get Searchable Fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        // TODO: Implement getFieldsSearchable() method.
    }

    /**
     * Set Presenter
     *
     * @param $presenter
     * @return mixed
     */
    public function setPresenter($presenter)
    {
        // TODO: Implement setPresenter() method.
    }

    /**
     * Skip Presenter Wrapper
     *
     * @param bool $status
     * @return $this
     */
    public function skipPresenter($status = true)
    {
        // TODO: Implement skipPresenter() method.
    }

    public function updateWhere($field, $value, array $attributes)
    {
        $this->model->where($field, $value)->update($attributes);
        return $this;
    }


    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->model->get()->count();
    }


    /**
     * @param $limit
     * @param $column
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function limitedWithCondition($limit, $column, $operator, $value)
    {
        $this->model->where($column, $operator, $value)->take($limit);
        return $this;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function limited($limit)
    {
        $this->model->take($limit);
        return $this;
    }

    /**
     * Set the default date-time
     */
    public function getDefaultDateTime() {
        date_default_timezone_set("Asia/Kolkata");
        return time() + (7 * 24 * 60 * 60);
    }

}
