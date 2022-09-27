<?php

namespace App\Models\SG;

use App\Rrhh\OrganizationalUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisionGuideline extends Model
{
    use HasFactory;

    protected $table = [
        'sg_supervision_guidelines'
    ];

    public function organizations()
    {
        return $this->belongsToMany(OrganizationalUnit::class, 'sg_organizational_unit',
        'organizational_unit_id', 'sg_supervision_guideline_id');
    }
}
