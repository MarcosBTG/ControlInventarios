<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Containers\ContainersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\DescriptionContainerModel;
use App\ContainerModel;
use App\UbicationModel;

class ContainersController extends Controller
{
    public function index() {
        //Auth::check()
        if (!Auth::guest()) {
            $query = ContainerModel::where('status', '<', '3');
            $containers = $query->orderBy('id', 'desc')->paginate(5);

            return view('containers/index',['containers' => $containers]);
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Auth::guest()) {
            $query = DescriptionContainerModel::select('container.id as container_id','container.type as type','container.capacity as capacity','container.ubication_id as ubication_id','description_container.origin as origin','description_container.destinity as destinity', DB::raw('concat(users.name, " ", users.surnames) as name'))
                    ->join('container', 'description_container.container_id', '=', 'container.id')
                    ->join('users', 'description_container.user_id', '=', 'users.id')
                    ->where('container.id','=',$id);
            
            $containers = $query->paginate(15);
            return view('containers.show', ['containers' => $containers]);
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Auth::guest()) {
            $container = ContainerModel::findOrFail($id);
            $ubications = UbicationModel::all();
            //die(json_encode($container));
            return view('containers.update', ['container' => $container, 'ubications' => $ubications]);
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContainersRequest $request, $id) {
        if (!Auth::guest()) {
            $contenedor = ContainerModel::findOrFail($id);
            $contenedor->ubication_id = $request->select_ubication;
            $contenedor->save();
            
            //die(json_encode($new));
            $update_des = DescriptionContainerModel::select('id','destinity')->where('container_id', '=', $id)->first();
            
            $description = DescriptionContainerModel::findOrFail($update_des->id);
            $description->origin = $update_des->destinity;
            $description->destinity = $request->select_ubication;
            $description->user_id = Auth::user()->id;
            $description->save();
            return redirect()->action('ProductsController@index')->with('actualizado', "Registro actualizado con éxito.");
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }
    
    public function UpdateDescription($id, $contenedor, $ubication) {
            $description = DescriptionContainerModel::findOrFail($id);
            $description->origin = $contenedor->ubication_id;
            $description->destinity = $ubication;
            $description->user_id = Auth::user()->id;
            $description->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }
}
