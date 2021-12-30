<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->retCat();

        $libros = Libro::paginate();

        return view('libro.index', compact('libros', 'categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }
    private function retCat() 
    {
        $cat = Categoria::get();
        $categorias = [];
        foreach ($cat as $item)
            $categorias[$item->id] = $item->nombre;
        return $categorias;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->retCat();

        $libro = new Libro();
        return view('libro.create', compact('libro', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Libro::$rules);

        $libro = Libro::create($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorias = $this->retCat();
        $libro = Libro::find($id);

        return view('libro.show', compact('libro', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = $this->retCat();
        $libro = Libro::find($id);

        return view('libro.edit', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        request()->validate(Libro::$rules);

        $libro->update($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $libro = Libro::find($id)->delete();

        return redirect()->route('libros.index')
            ->with('success', 'Libro eliminado');
    }
}
