<?php

namespace App\Models\Suerte;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Dado extends Model
{
    use LogsActivity;

    protected $table = 'dado';

    protected $fillable = [
        'dd_id',
        'dd_codigo',
        'dd_descripcion',
        'dd_fecha',
        'dd_resultado',
        'created_at'
    ];

    protected $guarded = 'dd_id';

    protected $primaryKey = 'dd_id';

    protected static $logName = 'dd_id';

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getActivitylogOptions(): LogOptions { return LogOptions::defaults(); }

    public function Cara()
    {
        return $this->belongsTo(
            'App\Models\Atencion\Cara',
            'dd_id',
            'cr_dd'
        );
    }

    public function getResultado($id)
    {
        $Dado=Dado::select('cr_descripcion')->join('cara','dd_id','cr_dd')->whereRaw('cr_orden=dd_resultado and dd_fecha<=GETDATE() and dd_id='.$id)->get();
        if(count($Dado)>0) return $Dado[0]->cr_descripcion;
        else return 'Sin resultado';
    }
}
