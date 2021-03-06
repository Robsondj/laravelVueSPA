<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Property;
use App\Http\Requests\ContractValidator;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::orderBy('id', 'DESC')->get()->toArray();
        return $contracts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractValidator $request)
    {
        $contract = new Contract($request->all());
        $contract->document = $this->removeMask($contract->document);
        $contract->save();
        return response()->json('Contrato adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::find($id);
        return response()->json($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ContractValidator $request)
    {
        $contract = Contract::find($id);
        $arrData = $request->all();
        $arrData['document'] = $this->removeMask($arrData['document']);
        $contract->update($arrData);
        return response()->json('Contrato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $contract = Contract::find($id);
        $contract->delete();
        return response()->json('Contrato removido com sucesso!');
    }

    /**
     * Return the active and not used properties
     *
     * @return  array
     */
    public function getProperties()
    {
        $properties = Property::where('active','=',true)->orderBy('id', 'DESC')->get();
        $arrProperties = array();
        foreach ($properties as $property) {
            if (!$property->contract()->count()) {
                $arrProperties[] = $property;
            }
        }
        return $arrProperties;
    }

    /**
     * Return the active and not used properties
     *
     * @param integer
     * @return  array
     */
    public function getPropertiesEdit($id)
    {
        $properties = Property::where('active','=',true)->orWhere('id',$id)->orderBy('id', 'DESC')->get();
        $arrProperties = array();
        foreach ($properties as $property) {
            if (!$property->contract()->count() || $property->id == $id) {
                $arrProperties[] = $property;
            }
        }
        return $arrProperties;
    }

    /**
     * Return property by id
     *
     * @param  integer
     * @return object
     */
    public function getPropertiySelected($id)
    {
        return Property::find($id);
    }

    /**
     * Return the document without the mask
     *
     * @param  string
     * @return string
     */
    private function removeMask($document)
    {
        return str_replace(array('.','-','/'),'', $document);
    }

    /**
     * Return the document with the mask
     *
     * @param  string
     * @return string
     */
    private function addMask($document) 
    {
        return strlen($document) == 11 ? $this->addMaskCpf($document) : $this->addMaskCnpj($document);
    }

    /**
     * Return the document with the mask
     *
     * @param  string
     * @return string
     */
    private function addMaskCnpj($cnpj) 
    {
        $formated  = substr($cnpj,0,2).'.';
        $formated .= substr($cnpj,2,3).'.';
        $formated .= substr($cnpj,5,3).'/';
        $formated .= substr($cnpj,8,4).'-';
        $formated .= substr($cnpj,12,2);
        return $formated;
    }
    
    /**
     * Return the document with the mask
     *
     * @param  string
     * @return string
     */
    private function addMaskCpf($cpf) 
    {
        $formated  = substr($cpf,0,3).'.';
        $formated .= substr($cpf,3,3).'.';
        $formated .= substr($cpf,6,3).'-';
        $formated .= substr($cpf,9,2);
        return $formated;
    }
}
