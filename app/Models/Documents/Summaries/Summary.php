<?php

namespace App\Models\Documents\Summaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'document_id','resolution_number','summary_date','type','creator_id','fiscal_id','matter'
    ];

    // public function type(){
    //     return $this->belongsTo('App\Models\Documents\Summaries');
    // }

    public function creator(){
        return $this->belongsTo('App\User','creator_id');
    }

    public function fiscal(){
        return $this->belongsTo('App\Models\Documents\Summaries\Fiscal');
    }

    public function events(){
        return $this->hasMany('App\Models\Documents\Summaries\SummaryEvent');
    }

    protected $table = 'doc_summaries';
    protected $dates = ['summary_date'];
}
