<?php

namespace App\Models\Seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Roles extends Authenticatable
{
    // use Notifiable;
    use LogsActivity;
    use HasRoles;

    protected $remember_token = false;

    protected $table = 'model_has_roles';

    protected $fillable = ['role_id', 'model_type', 'model_id'];

    protected static $logName = 'model_has_roles';

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function Usuario()
    {
        return $this->belongsTo('App\Models\Seguridad\Usuario', 'id', 'model_id');
    }

    public function Rol()
    {
        return $this->belongsTo('App\Models\Seguridad\Rol', 'role_id', 'id');
    }
}
