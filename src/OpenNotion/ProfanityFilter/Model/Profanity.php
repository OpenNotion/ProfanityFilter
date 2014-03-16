<?php

namespace OpenNotion\ProfanityFilter\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Model representing a single profanity.
 *
 * @package OpenNotion\ProfanityFilter
 */
class Profanity extends Eloquent
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'profanities';
	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = array();
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('profanity', 'replacement');

} 
