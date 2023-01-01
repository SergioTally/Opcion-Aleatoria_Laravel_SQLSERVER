<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class URL extends Model
{
    use LogsActivity;

    protected $table = 'url';

    protected $fillable = ['url_session', 'url_id'];

    protected $guarded = 'url_id';

    protected $primaryKey = 'url_id';

    protected static $logName = 'url';

    

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
