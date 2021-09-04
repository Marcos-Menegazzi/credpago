<?php

namespace App\Scopes;

use \Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Scope;
use \Illuminate\Database\Eloquent\Model;

class UserScope implements Scope {
	/**
	 * @inheritdoc
	 *
	 * @param Builder $builder
	 * @param Model $model
	 *
	 * @return Builder|void
	 */
	public function apply( Builder $builder, Model $model ) {

		if(auth()->user()) {
			return $builder->where( 'user_id', '=', auth()->user()->id );
		}

		return $builder;
	}
}