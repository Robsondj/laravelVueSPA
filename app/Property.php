<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	protected $fillable = [
		'owner_email',
		'street',
		'number',
		'complement',
		'neighborhood',
		'city',
		'state'];
}
