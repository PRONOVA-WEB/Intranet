<?php

namespace App\Models\Documents\Summaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SummaryEvent extends Model implements Auditable
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
        'id', 'event_date','creator_id','summary_id','status_id','granted_days','observation'
    ];

    public function summary(){
        return $this->belongsTo('App\Models\Documents\Summaries\Summary');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Documents\Summaries\SummaryStatus');
    }

    public function creator(){
        return $this->belongsTo('App\User','creator_id');
    }

    protected $table = 'doc_summary_events';
    protected $dates = ['event_date'];
}
