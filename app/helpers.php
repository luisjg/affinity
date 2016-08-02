<?php

function updateCount($interest)
{
	$interest->count = $interest->count + 1;
	$interest->save();

	if($interest->parent_attribute_id)
	{
		$model = get_class($interest);

		$parent = $model::find($interest->parent_attribute_id);

		return updateCount($parent);
	}
}