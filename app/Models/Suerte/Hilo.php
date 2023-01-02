<?php

namespace App\Models\Suerte;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Hilo extends Model
{
    use LogsActivity;

    protected $table = 'hilo';

    protected $fillable = [
        'hl_id',
        'hl_tck',
        'hl_descripcion',
        'hl_usr',
        'hl_orden',
        'created_at'
    ];

    protected $guarded = 'hl_id';

    protected $primaryKey = 'hl_id';

    protected static $logName = 'hl_id';

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions { return LogOptions::defaults(); }
}
