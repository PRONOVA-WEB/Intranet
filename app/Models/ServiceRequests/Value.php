<?php

namespace App\Models\ServiceRequests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    public $table = 'sr_values';

    protected $fillable = [
        'contract_type','type','work_type','profession_id','amount', 'validity_from', 'estate'
    ];

    public function profession(){
      return $this->belongsTo('App\Models\Parameters\Profession');
    }
}
