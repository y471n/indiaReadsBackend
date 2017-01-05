<?php

/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 23/07/15
 * Time: 6:11 PM
 */


namespace App\IndiaReads\Repository\Contracts;

/**
 * Interface for every basic repository
 *
 * A basic repository is a repository that has standard query capability
 */
/**
 * Interface BaseRepositoryInterface
 * @package App\IndiaReads\Repository\Contracts
 */
interface BaseRepositoryInterface {

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     * @return mixed
     */
    public function all();

    /**
     * Retrieve all data of repository, paginated
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = array('*'));

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = array('*'));

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere( array $where , $columns = array('*'));

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, array $data);

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     * @return int
     */
    public function delete($id);

    /**
     * Load relations
     *
     * @param $relations
     * @return $this
     */
    public function with($relations);

    /**
     * Set hidden fields
     *
     * @param array $fields
     * @return $this
     */
    public function hidden(array $fields);

    /**
     * Set visible fields
     *
     * @param array $fields
     * @return $this
     */
    public function visible(array $fields);

    /**
     * Query Scope
     *
     * @param \Closure $scope
     * @return $this
     */
    public function scopeQuery(\Closure $scope);

    /**
     * Get Searchable Fields
     *
     * @return array
     */
    public function getFieldsSearchable();

    /**
     * Set Presenter
     *
     * @param $presenter
     * @return mixed
     */
    public function setPresenter($presenter);

    /**
     * Skip Presenter Wrapper
     *
     * @param bool $status
     * @return $this
     */
    public function skipPresenter($status = true);


    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findMultipleWhere(array $where, $columns = array('*'));
}
