<?php

namespace App\Models\Seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    // use Notifiable;
    use LogsActivity;
    use HasRoles;

    protected $remember_token = false;

    protected $table = 'usuario';

    protected $fillable = ['id', 'usu_nombre', 'usu_nombrelargo', 'usu_pwd', 'usu_activo', 'usu_empleado'];

    protected $guarded = 'id';

    protected $primaryKey = 'id';

    protected static $logName = 'usuario';

    protected static $ignoreChangedAttributes = ['usu_pwd', 'created_at', 'updated_at'];

    protected static $recordEvents=['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    public function getAuthPassword()
    {
        return $this->usu_pwd;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getNombre()
    {
        return $this->roles;
    }

    public function getNombreLargo()
    {
        return $this->usu_nombrelargo;
    }

    public function getNombreCompleto($id)
    {
        $usuario = new Usuario;
        $usuario = $usuario->where('id', '=', $id)->first();

        return $usuario->usu_nombrelargo;
    }

    public function Empleados()
    {
        return $this->belongsTo('App\Models\Planilla\Empleado', 'usu_empleado', 'empl_id');
    }

    public function Terminales()
    {
        return $this->belongsToMany('App\Models\Parametros\Terminal', 'accesoTerminal', 'acct_usuario', 'acct_terminal')->withTimestamps();
    }

    public function Empresas()
    {
        return $this->belongsToMany('App\Models\Parametros\Empresa', 'accesoEmpresa', 'acce_usuario', 'acce_empresa')->withTimestamps();
    }

    public function SearchRol($Usuario, $Rol)
    {
        $Usuario=Usuario::join('model_has_roles','model_id','usuario.id')
            ->join('roles','role_id','roles.id')
            ->where('name',$Rol)
            ->where('usuario.id',$Usuario)
            ->get();

        if(count($Usuario)==0) return false;
        else return true;
    }

    public function setSession()
    {
        //   if(count($roles)==1){
        Session::put(
            [
                //   'rol_id' => $roles[0]['id'],
                //   'rol_nombre' => $roles[0]['nombre'],
                'usuario_nombre' => $this->usu_nombre,
                'usuario_id' => $this->usu_id,
                // 'usuario' =>$this->email,
                // 'empresas'=>$this->Empresas()->pluck('emp_codigo')->toArray(),
                // 'sucursales'=>$this->Sucursales()->pluck('suc_codigo')->toArray()
            ]
        );
        //  } else {

        // }
    }
}
