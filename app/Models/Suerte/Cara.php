<?php

namespace App\Models\Suerte;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cara extends Model
{
    use LogsActivity;

    protected $table = 'cara';

    protected $fillable = [
        'cr_id',
        'cr_dd',
        'cr_descripcion',
        'cr_orden',
        'created_at'
    ];

    protected $guarded = 'cr_id';

    protected $primaryKey = 'cr_id';

    protected static $logName = 'cr_id';

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions { return LogOptions::defaults(); }
}
