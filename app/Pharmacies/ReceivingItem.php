<?php

namespace App\Pharmacies;

use Illuminate\Database\Eloquent\Model;

class ReceivingItem extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'barcode', 'receiving_id', 'product_id', 'amount', 'unity', 'due_date',
      //'serial_number',
      'batch', 'created_at'
  ];

  protected $table = 'frm_receiving_items';

  //relaciones
  public function receiving()
  {
    return $this->belongsTo('App\Pharmacies\Receiving','receiving_id');
  }

  public function product()
  {
    return $this->belongsTo('App\Pharmacies\Product','product_id')->withTrashed();
  }

}
