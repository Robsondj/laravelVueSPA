<?php

namespace App\Http\Controllers;

use App\Property;
use App\Http\Requests\PropertyValidator;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::where('active','=',true)->orderBy('id', 'DESC')->get();
        $arrProperties = array();
        foreach ($properties as $key => $property) {
            $arrProperties[$key] = $property->toArray();
            $arrProperties[$key]['status'] = $property->status;
        }
        return $arrProperties;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyValidator $request)
    {
        $property = new Property($request->all());
        $property->save();

        return response()->json('Imóvel adicionado com sucesso!');
    }

    /**
     * Find to editing the specified resource.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        return response()->json($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, PropertyValidator $request)
    {
        $property = Property::find($id);
        $property->update($request->all());
        return response()->json('Imóvel atualizado com sucesso!');
    }

   /**
     * Update field active from properties to false.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $property = Property::find($id);
        $property->active = false;
        $property->update();
        return response()->json('Imóvel removido com sucesso!');
    }

    /**
     * Return all states of Brasil
     *
     * @return array
     */
    public function getStates()
    {
        return array('AC'
           ,'AL'
           ,'AP'
           ,'AM'
           ,'BA'
           ,'CE'
           ,'DF'
           ,'ES'
           ,'GO'
           ,'MA'
           ,'MT'
           ,'MS'
           ,'MG'
           ,'PA'
           ,'PB'
           ,'PR'
           ,'PE'
           ,'PI'
           ,'RJ'
           ,'RN'
           ,'RS'
           ,'RO'
           ,'RR'
           ,'SC'
           ,'SP'
           ,'SE'
           ,'TO');
    }
}
