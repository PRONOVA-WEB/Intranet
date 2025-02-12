<?php

namespace App\Models\Drugs;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocol extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sample',
        'result',
        'user_id',
        'reception_item_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drg_protocols';

    public function receptionItem()
    {
        return $this->belongsTo(ReceptionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
