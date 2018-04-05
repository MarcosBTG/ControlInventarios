<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ProductsModel;

class ProductsController extends Controller {

    public function index() {

        $search = Input::get('search');
        $btn_filter = 0;
        $query = ProductsModel::select('sku', 'name', 'description')->where('status', '!=', '0');
        //die(json_encode($query));
        if (!empty($search)) {
            $btn_filter = 1;
            $query->where('sku', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->where('status', '!=', '0');
            if ($query->count('*') <= 0) {
                return redirect('/products/index')->with('message', 'No se encontraron coincidencias')->with('type', 'warning_alert');
            }
        }
        $products = $query->orderBy('id')->paginate(10);
        //['products' => $products, 'btn_filter' => $btn_filter]
        return view('products/index', ['products' => $products, 'btn_filter' => $btn_filter]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(ProductosRequest $request) {
    public function store(Request $request) {
        $producto=new Productos();
        $producto->nombre=$request->nombre;
        $producto->categoria=$request->categoria;
        $producto->cantidad=$request->cantidad;
        $producto->save();
    
        return redirect()->action('ProductosController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        return view('productos.editar',['producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $producto = Productos::findOrFail($id);//realizamos la busqueda de los registros
        //recibimos los valores nuevos 
        $producto->nombre=$request->nombre;
        $producto->categoria=$request->categoria;
        $producto->cantidad=$request->cantidad;
        //guardamos los cambios
        $producto->save();
        return redirect()->action('ProductosController@index');//al terminar de guardar nos envia al index
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
