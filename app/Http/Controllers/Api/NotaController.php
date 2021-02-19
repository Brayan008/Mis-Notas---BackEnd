<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use App\Http\Requests\SaveNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use \MongoDB\BSON\UTCDateTime as MongoDate;


class NotaController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => "success",
            'notas' => Nota::orderBy('created_at', 'desc')->get()
        ]);
    }


    /**
     * Almacene un recurso recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //recibiendo
        $data = $request -> all();

        //Validaciones
        $validator = Validator::make($data, SaveNota::rules());
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

            
        $data = $validator->validated();
        //$data['date'] = new MongoDate(strtotime($data['date']) * 1000);


        return response()->json([
            'status' => 'success',
            'nota' => Nota::create($data)
        ]);
        
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        return response()->json([
            'status' => 'success',
            'nota' => $nota
        ]);
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        $data = $request -> all();

        //Validaciones
        $validator = Validator::make($data, SaveNota::rules());
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

            
        $data = $validator->validated();

        $nota->update($data);


        return response()->json([
            'status' => 'success',
            'nota' => $nota
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();

        return response()->json([
            'status' => 'success',
            'nota' => $nota
        ]);
    }


    public function notasLim()
    {
        return response()->json([
            'status'=> 'success',
            'notas' => Nota::orderBy('created_at', 'desc')->take(3)->get()
        ]);
    }


}
