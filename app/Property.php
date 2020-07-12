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

	public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function getStatusAttribute()
    {
    	if ($this->contract()->count()) {
    		return'Contratado';
    	}
    	return 'Não Contratado';
    }

}
