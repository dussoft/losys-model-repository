<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'userId',
        'options',
        'projectId',
        'companyId',
        'created_by'
    ];
}
