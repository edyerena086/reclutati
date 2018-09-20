<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use ReclutaTI\CandidateAddress;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\AddressRequest;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $response;

        $address = new CandidateAddress();
        $address->candidate_id = Auth::user()->candidate->id;
        $address->street = $request->calle;
        $address->external_number = $request->numeroExterior;
        if ($request->has('numeroInterior')) {
            $address->internal_number = $request->numeroInterior;
        }
        $address->colony = $request->colonia;
        $address->city = $request->ciudad;
        $address->state_id = $request->estado;
        $address->zipcode = $request->codigoPostal;

        if ($address->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito tu dirección.'
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido guardar tu dirección',
                'error_code' => 's0001'
            ];
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $response;

        $address = CandidateAddress::where('candidate_id', Auth::user()->candidate->id)->where('id', $id)->firstOrFail();

        $address->street = $request->calle;
        $address->external_number = $request->numeroExterior;
        $address->internal_number = $request->numeroInterior;
        $address->colony = $request->colonia;
        $address->city = $request->ciudad;
        $address->state_id = $request->estado;
        $address->zipcode = $request->codigoPostal;

        if ($address->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha actualizado con éxito tu dirección.'
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido actualizar tu dirección',
                'error_code' => 's0001'
            ];
        }

        return response()->json($response);
    }
}
