<?php

namespace App\Models\Seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Rol extends Authenticatable
{
    // use Notifiable;
    use LogsActivity;
    use HasRoles;

    protected $remember_token = false;

    protected $table = 'roles';

    protected $fillable = ['id', 'name', 'guard_name'];

    protected $guarded = 'id';

    protected $primaryKey = 'id';

    protected static $logName = 'roles';

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
