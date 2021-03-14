<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzaController extends Controller
{
    // action for /pizzas route
    public function index(){
        // $pizzas = Pizza::all();
        // $pizzas = Pizza::orderBy('name')->get();
        // $pizzas = Pizza::orderBy('name', 'desc')->get();
        // $pizzas = Pizza::where('type', 'hawaian')->get();
        $pizzas = Pizza::latest()->get();
        return view('pizzas.index', ['pizzas'=>$pizzas]);
    }
    // action for /pizzas/id route
    public function show($id){
        $pizza = Pizza::findOrFail($id);
        return view('pizzas.show', ['pizza'=>$pizza]);
    }
    // action for /pizzas/create route
    public function create(){
        return view('pizzas.create');
    }

    public function store(){
        $pizza = new Pizza();
        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');
        $pizza->save();
        return redirect('/')->with('msg', 'Thanks for your order');
    }

    public function destroy($id){
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();
        return redirect('/pizzas');
    }
}
