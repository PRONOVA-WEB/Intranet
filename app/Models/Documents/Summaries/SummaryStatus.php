<?php

namespace App\Models\Documents\Summaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SummaryStatus extends Model implements Auditable
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
      'id', 'name','granted_days'
  ];

  //apertura - notificación al fiscal - formulación de cargos - solicita sobreseimiento - prorroga - cerrar el sumario reapertura.

  protected $table = 'doc_summary_status';

}
