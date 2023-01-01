<?php

namespace App\Models\Seguridad;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    protected $fillable = ['id', 'log_name', 'description', 'subject_type', 'batch_uuid', 'subject_id', 'causer_type', 'causer_id', 'properties', 'who'];

    protected $guarded = 'id';

    protected $primaryKey = 'id';

    protected static $logName = 'activity_log';

    

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function Usuario()
    {
        return $this->belongsTo('App\Models\Seguridad\Usuario', 'activity_log.causer_id', 'usuario.id');
    }

    public function getUsuario($idActivity)
    {
        return ActivityLog::join('usuario', 'activity_log.causer_id', 'usuario.id')->find($idActivity)->usu_nombre;
    }
}
