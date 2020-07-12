<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
		'property_id',
		'person_type',
		'document',
		'contractor_email',
		'contractor_name'];

	public function property()
    {
        return $this->hasOne(Property::class);
    }
}
