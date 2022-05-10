<?php

namespace App\Models\Documents\CustomSignatureFlows;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CustomSignatureFlow extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','ou_id','flow_name','creator_id'
    ];

    public function creator(){
        return $this->belongsTo('App\User','creator_id');
    }

    public function organizationalUnit() {
        return $this->belongsTo('\App\Rrhh\OrganizationalUnit','ou_id');
    }

    public function signatories() {
    	return $this->hasMany('\App\Models\Documents\CustomSignatureFlows\CustomSignatureFlowSignatory','doc_custom_signature_flow_id');
    }

    protected $table = 'doc_custom_signature_flow';
}
