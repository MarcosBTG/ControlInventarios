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

//        $search = Input::get('search');
//        $btn_filter = 0;
//  , 'btn_filter' => $btn_filter
        $query = ProductsModel::select('sku', 'name', 'description')->where('status', '!=', '0')->orderBy('id','desc');
        
        $products = $query->orderBy('id')->paginate(3);
    
        return view('products/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request) {

        $producto = new ProductsModel();
        $producto->sku = trim(preg_replace('/( ){2,}/u', ' ', $request->sku)); //1ra en mayuscula, para evitar espacios en blanco
        $producto->name = trim(preg_replace('/( ){2,}/u', ' ', $request->name));
        $producto->description = trim(preg_replace('/( ){2,}/u', ' ', $request->description));
        $producto->status = 1;
        $producto->container_id = trim(preg_replace('/( ){2,}/u', ' ', $this->setContainer()));
        
        $producto->save();
        
        if ($producto->save()) {
            return redirect()->action('ProductsController@index')->with('exito', "Registro realizado con éxito.")->with('type', 'alert-success');
        }else {
            return redirect()->action('ProductsController@index')->with('error', "No se pudo realizar el registro.")->with('type', 'alert-danger');
        }

    }

//setContainer
    public function setContainer() {
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
    }

    //getContainer
    public function getContainer() {
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
    }

    public function getTypeContainer() {
        $type = mt_rand(1, 2);
        return $type;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //la informacion se manda por url por ese motivo se utiliza get
        $producto = Productos::findOrFail($id);
        return view('productos.editar', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $producto = Productos::findOrFail($id); //realizamos la busqueda de los registros
        //recibimos los valores nuevos 
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->cantidad = $request->cantidad;
        //guardamos los cambios
        $producto->save();
        return redirect()->action('ProductosController@index'); //al terminar de guardar nos envia al index
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Productos::findOrFail($id)->delete();
        return redirect()->action('ProductosController@index');
    }

}
