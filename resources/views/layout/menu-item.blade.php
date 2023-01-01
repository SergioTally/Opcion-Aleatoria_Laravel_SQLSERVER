@role('Super Administrador')
    @if ($item['submenu']==[])
        <li class="nav-item {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
            <a href="{{url($item['men_url'])}}" class="nav-link {{getMenuActivo($item['men_url'])}} {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
                <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
                <p>{{$item["men_nombre"]}}</p>
            </a>
        </li>

    @else
        @if(isset($Temp))
            <input id="Menu" name="Menu" type="hidden" value="{{$X=255, $Y=255, $Z=255,$Temp=$Temp+1}}">
            @else
            <input id="Menu" name="Menu" type="hidden" value="{{$X=255, $Y=255, $Z=255, $Temp=0}}">
        @endif
        @switch($Temp)
            @case(1)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=80, $Y=170, $Z=240}}">
                @break
            @case(2)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=30, $Y=120, $Z=190}}">
                @break
            @case(3)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=10, $Y=80, $Z=145}}">
                @break
            @default
                <input id="Menu" name="Menu" type="hidden" value="{{$X=208, $Y=230, $Z=255}}">
                @break
        @endswitch
        <li class="nav-item has_treeview {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
            <a href="#" style="color:rgb({{$X}}, {{$Y}}, {{$Z}});" style="color:rgb(150, 73, 204);"
                class="nav-link {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'font-weight-bold':'disabled'}}">
                <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
                <p> {{$item['men_nombre']}}
                    <i class="right fas fa-angle-left"></i>
                </p>
                @if($item["men_nombre"]=='Atencion')
                    <p class="ml-2 mr-5 text-md text-red">{{Alertas()}}</p>
                @endif
            </a>
            <ul class="nav nav-treeview">
                @foreach ($item["submenu"] as $submenu)
                    @include("layout.menu-item",["item"=>$submenu])
                @endforeach
            </ul>
        </li>
    @endif
@else
<?php
    $agents=auth()->user()->getAllPermissions()->pluck('name');
    $Padres=array();
    array_push($Padres, '-');
    $Menus='';
    foreach ($agents as $agent=>$value) {
        $Temp=explode(' ', "{$agent}=>{$value}");
        $Temp=explode('/', $Temp[1]);
        try{
            if($Temp[1])array_push($Padres, $Temp[1]);
        }
        catch(Exception $e){}

        try{
            if($Temp[2])array_push($Padres, $Temp[2]);
        }
        catch(Exception $e){}

        try{
            if($Temp[3])array_push($Padres, $Temp[3]);
        }
        catch(Exception $e){}

        array_push($Padres, $Temp[0]);
    }
?>

@if($item["men_id"]!=99)
    @if ($item['submenu']==[])
        <li {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'hidden'}}
            class="nav-item {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'disabled'}}">
            <a {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])))?'':'hidden'}} href="{{url($item['men_url'])}}"
                class="nav-link {{getMenuActivo($item['men_url'])}}
            {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'disabled'}}">

            <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
                <p>{{$item["men_nombre"]}}</p>
            </a>
        </li>
    @else
        @if(isset($Temporal))
            <input id="Menu" name="Menu" type="hidden" value="{{$X=255, $Y=255, $Z=255,$Temporal++}}">
            @else
            <input id="Menu" name="Menu" type="hidden" value="{{$X=255, $Y=255, $Z=255, $Temporal=0}}">
        @endif
        @switch($Temporal)
            @case(1)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=80, $Y=170, $Z=240}}">
                @break
            @case(2)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=30, $Y=120, $Z=190}}">
                @break
            @case(3)
                <input id="Menu" name="Menu" type="hidden" value="{{$X=10, $Y=80, $Z=145}}">
                @break
            @default
                <input id="Menu" name="Menu" type="hidden" value="{{$X=208, $Y=230, $Z=255}}">
                @break
        @endswitch
        @if (array_search($item['men_url'], array_unique($Padres))>0)
        <li class="nav-item has_treeview ">
            <a  href="#" style="color:rgb({{$X}}, {{$Y}}, {{$Z}});" class="nav-link ">
                <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
                <p> {{$item["men_nombre"]}} <i class="right fas fa-angle-left"></i> </p>
                @if($item["men_nombre"]=='Atencion')
                    <p class="ml-2 mr-5 text-md text-red" style="position: absolute;text-align: center;">
                    <p class="text-red" style="z-index: 0; position: absolute;font-size: 0.9rem;">.{{Alertas()}}</p>
                    <i class="fas fa-square text-red" style="font-weight: unset; font-size: 1.8rem;"></i>
                    </p>
                @endif
            </a>
            <ul class="nav nav-treeview">
                @foreach ($item["submenu"] as $submenu)
                @include("layout.menu-item",["item"=>$submenu])
                @endforeach
            </ul>
        </li>
        @endif
    @endif
@endif
@endrole
