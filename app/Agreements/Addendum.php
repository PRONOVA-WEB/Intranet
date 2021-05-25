<?php

namespace App\Agreements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addendum extends Model
{
    use SoftDeletes;

    public function agreement() {
        return $this->belongsTo('App\Agreements\Agreement');
    }

    public function fileToEndorse() {
        return $this->belongsTo('App\Models\Documents\SignaturesFile', 'file_to_endorse_id');
    }

    public function fileToSign() {
        return $this->belongsTo('App\Models\Documents\SignaturesFile', 'file_to_sign_id');
    }

    public function referrer() {
        return $this->belongsTo('App\User', 'referrer_id');
    }

    public function director() {
        return $this->belongsTo('App\User', 'director_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'file', 'res_number', 'res_date', 'res_file', 'agreement_id', 'file_to_endorse_id', 'file_to_sign_id', 'referrer_id', 'director_id', 'director_appellative', 'director_decree', 'representative', 'representative_rut', 'representative_appellative', 'representative_decree'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'date', 'res_date'];

    protected $table = 'agr_addendums';
}
