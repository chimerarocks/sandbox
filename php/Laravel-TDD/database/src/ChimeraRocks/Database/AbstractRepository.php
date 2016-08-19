<?php

namespace ChimeraRocks\Database;

use ChimeraRocks\Database\Contracts\CriteriaCollectionInterface;
use ChimeraRocks\Database\Contracts\CriteriaInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface, CriteriaCollectionInterface
{
	protected $model;

	protected $isIgnoreCriteria = false;

	protected $criteriaCollection = [];

	public function __construct()
	{
		$this->makeModel();
	}

	abstract public function model();

	public function makeModel()
	{
		$class = $this->model();
		$this->model = new $class;
		return $this->model;
	}

	public function all(array $columns = ['*'])
	{
		$this->applyCriteria();
		return $this->model->get($columns);
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function update(array $data, $id)
	{
		$model = $this->find($id);
		$model->update($data);
		return $model;
	}

	public function delete($id)
	{
		$model = $this->find($id);
		return $model->delete();
	}

	public function find($id, array $columns = ['*'])
	{
		$this->applyCriteria();
		return $this->model->findOrFail($id, $columns);
	}

	public function findBy($field, $value, $columns = ['*'])
	{
		$this->applyCriteria();
		return $this->model->where($field, '=',$value)->get($columns);
	}

	public function addCriteria(CriteriaInterface $criteria)
	{
		$this->criteriaCollection[] = $criteria;

		return $this;
	}

	public function getCriteriaCollection()
	{
		return $this->criteriaCollection;
	}

	public function getByCriteria(CriteriaInterface $criteria)
	{
		$this->model = $criteria->apply($this->model, $this);
		return $this;
	}

	public function applyCriteria()
	{
		if ($this->isIgnoreCriteria) {
			return $this;
		}

		foreach ($this->getCriteriaCollection() as $criteria) {
			$this->model = $criteria->apply($this->model, $this);
		}

		return $this;
	}

	public function ignoreCriteria($isIgnore = true)
	{
		$this->isIgnoreCriteria = $isIgnore;
		return $this;
	}

	public function clearCriteria()
	{
		$this->criteriaCollection = [];
		$this->makeModel();
		return $this;
	}
}