<?php

namespace ChimeraRocks\Database\Contracts;

use ChimeraRocks\Database\Contracts\CriteriaInterface;

interface CriteriaCollectionInterface
{
	public function addCriteria(CriteriaInterface $criteria);

	public function getCriteriaCollection();

	public function getByCriteria(CriteriaInterface $criteria);

	public function applyCriteria();

	public function ignoreCriteria($isIgnore);

	public function clearCriteria();
}