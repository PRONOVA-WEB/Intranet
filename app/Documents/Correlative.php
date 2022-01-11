<?php

namespace App\Documents;

use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNull;

class Correlative extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'correlative', 'year'
    ];

    public static function getCorrelativeFromType($type) {
        /* Obtener el objeto correlativo según el tipo */
        $correlative = Correlative::Where('type',$type)->orderBy('correlative','desc')->first();

        $correlativeNew = new Correlative();
        $correlativeNew->correlative = ($correlative) ? $correlative->correlative + 1 : 1;

        $correlativeNew->type  = $type;
        $correlativeNew->year  = date('Y');
        $correlativeNew->save();
        $number = $correlativeNew->correlative;
        /* Retornar el número actial */
        return $number;
    }

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'doc_correlatives';
}
