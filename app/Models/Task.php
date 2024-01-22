<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @mixin Builder
 */

class Task extends Model
{

	protected $fillable = [
		'title',
		'description',
		'is_complete'
	];

	protected $casts = [
		'is_complete' => 'bool'
	];
}