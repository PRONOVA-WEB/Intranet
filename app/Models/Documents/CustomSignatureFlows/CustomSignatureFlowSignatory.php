<?php

namespace App\Models\Documents\CustomSignatureFlows;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CustomSignatureFlowSignatory extends Model implements Auditable
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
        'id','doc_custom_signature_flow_id','signator_id','order'
    ];

    public function custom_signature_flow(){
        return $this->belongsTo('App\Models\Documents\CustomSignatureFlows\CustomSignatureFlow','doc_custom_signature_flow_id');
    }

    public function signator(){
        return $this->belongsTo('App\User','signator_id');
    }

    protected $table = 'doc_custom_signature_flow_signatories';
}
