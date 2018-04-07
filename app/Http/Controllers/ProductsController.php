<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Input;
use App\DescriptionContainerModel;
use App\ProductsModel;
use App\ContainerModel;
use App\User;

class ProductsController extends Controller {

    public function index() {
        //Auth::check()
        if (!Auth::guest()) {
            $query = ProductsModel::select('id', 'sku', 'name', 'description', 'container_id')->where('status', '!=', '0');
            $products = $query->orderBy('id', 'desc')->paginate(5);

            return view('products/index', ['products' => $products]);
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
        if (!Auth::guest()) {
            return view('products.create');
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request) {
        if (!Auth::guest()) {
            $producto = new ProductsModel();
            $producto->sku = ucfirst(trim(preg_replace('/( ){2,}/u', ' ', $request->sku))); //1ra en mayuscula, para evitar espacios en blanco y borrarlos
            $producto->name = ucfirst(trim(preg_replace('/( ){2,}/u', ' ', $request->name)));
            $producto->description = ucfirst(trim(preg_replace('/( ){2,}/u', ' ', $request->description)));
            $producto->status = 1;
            $producto->container_id = trim(preg_replace('/( ){2,}/u', ' ', $this->setContainer()));

            $producto->save();

            if ($producto->save()) {
                return redirect()->action('ProductsController@index')->with('exito', "Registro realizado con éxito.");
            } else {
                return redirect()->action('ProductsController@index')->with('error', "No se pudo realizar el registro.");
            }
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

//setContainer
    public function setContainer() {
        if (!Auth::guest()) {
            $contenedor = ContainerModel::findOrFail($this->getContainer());
            if ($contenedor->capacity == 1000 && $contenedor->status == 1) {
                $contenedor->status = 0;
                $contenedor->ubication_id = 2;
                $contenedor->save();

                $new_container = $this->getContainer();
            } else {
                $contenedor->capacity = $contenedor->capacity + 1;
                $contenedor->save();

                $description = new DescriptionContainerModel();
                $description->origin = 1;
                $description->destinity = 2;
                $description->status = 1;
                $description->container_id = $contenedor->id;
                $description->user_id = Auth::user()->id; //

                $description->save();

                $new_container = $this->getContainer();
            }
            return $new_container;
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    //getContainer
    public function getContainer() {
        if (!Auth::guest()) {
            $containers = ContainerModel::select('id')->where('status', '=', 1)->orderBy('capacity', 'asc')->get();
            if (count($containers) <= 0) {
                $contenedor = new ContainerModel();
                $contenedor->capacity = 0;
                $contenedor->type = $this->getTypeContainer();
                $contenedor->status = 1;
                $contenedor->ubication_id = 1;
                $contenedor->save();

                $new_container = ContainerModel::where('capacity', '=', 0)->first();
                $description = new DescriptionContainerModel();
                $description->origin = 1;
                $description->destinity = 2;
                $description->status = 1;
                $description->container_id = $new_container->id;
                $description->user_id = Auth::user()->id; // sse guardará con el id del usuario autentificado

                $description->save();
            } else {
                foreach ($containers as $container) {
                    $new = $container->id;
                }
                $new_container = $new;
            }
            return $new_container;
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    public function getTypeContainer() {
        if (!Auth::guest()) {

            $type = mt_rand(1, 2);
            return $type;
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Auth::guest()) {
            $producto = ProductsModel::findOrFail($id);
            //die(json_encode($producto));
            return view('products.update', ['product' => $producto]);
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
    public function update(Request $request, $id) {
        if (!Auth::guest()) {
            $producto = ProductsModel::findOrFail($id);

            $producto->sku = $request->sku;
            $producto->name = $request->name;
            $producto->description = $request->description;

            $producto->save();
            
            return redirect()->action('ProductsController@index')->with('actualizado', "Registro actualizado con éxito.");
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!Auth::guest()) {
            Productos::findOrFail($id)->delete();
            return redirect()->action('ProductosController@index');
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }
}
