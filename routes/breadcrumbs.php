<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Inicio
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});


//Inicio > Usuario
Breadcrumbs::for('usuario', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuario', route('usuario'));
});
// Inicio > Usuario > Crear
Breadcrumbs::for('usuario.crear', function ($trail) {
    $trail->parent('usuario');
    $trail->push('Crear Usuario', route('usuario.crear'));
});
// Inicio > Usuario > Editar
Breadcrumbs::for('usuario.editar', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Editar: '.$data->usu_nombre, route('usuario.editar', $data->id));
});

// Inicio > Usuario > Mostrar
Breadcrumbs::for('usuario.mostrar', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Ver: '.$data->usu_nombre, route('usuario.mostrar', $data->id));
});

//Inicio >Usuario >Editar >Contraseña
Breadcrumbs::for('usuario.editarC', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Editar contraseña del Usuario: '.$data->usu_nombre, route('usuario.editarC', $data->id));
});

//Inicio >Usuario >Editar >Contraseña
Breadcrumbs::for('usuario.editarCU', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Editar contraseña del Usuario: '.$data->usu_nombre, route('usuario.editarCU', $data->id));
});

//Inicio > Usuario > Roles
Breadcrumbs::for('usuario.roles', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar roles al Usuario: '.$data->usu_nombre, route('usuario.roles', $data->id));
});

// Inicio > Usuario > Permisos
Breadcrumbs::for('usuario.asignarPermisos', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Permisos: '.$data->usu_nombre, route('usuario.permisos', $data->id));
});

// Inicio > Usuario > Terminal
Breadcrumbs::for('usuario.terminal', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Terminal: '.$data->usu_nombre, route('usuario.terminales', $data->id));
});

// Inicio > Usuario > Empresa
Breadcrumbs::for('usuario.empresa', function ($trail, $data) {
    $trail->parent('usuario');
    $trail->push('Asignar Empresa: '.$data->usu_nombre, route('usuario.empresas', $data->id));
});

//Inicio > Rol
Breadcrumbs::for('rol', function ($trail) {
    $trail->parent('home');
    $trail->push('Rol', route('rol'));
});
// Inicio > Rol > Crear
Breadcrumbs::for('rol.crear', function ($trail) {
    $trail->parent('rol');
    $trail->push('Crear Rol', route('rol.crear'));
});

// Inicio > Rol > Permisos
Breadcrumbs::for('rol.asignarPermisos', function ($trail, $data) {
    $trail->parent('rol');
    $trail->push('Asignar Permisos: '.$data->name, route('rol.asignarPermisos', $data->id));
});

