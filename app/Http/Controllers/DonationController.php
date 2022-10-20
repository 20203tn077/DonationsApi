<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Utils\DonationUtils;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donation_list = Donation::orderBy('id', 'desc') -> get();
        return [
            'success' => true,
            'message' => 'Consulta exitosa',
            'data' => $donation_list
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donation = new Donation();
        DonationUtils::request_payment($donation, $request -> amount);
        $donation -> save();
        return [
            'success' => true,
            'message' => 'Donativo registrado',
            'data' => $donation
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        return [
            'success' => true,
            'message' => 'Consulta exitosa',
            'data' => $donation
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        if ($donation -> payment_status == 'STARTED') {
            $success = DonationUtils::confirm_payment($donation, $request -> amount_paid);
            $donation -> save();
            return [
                'success' => $success,
                'message' => $success ? 'Donativo finalizado' : 'Error al finalizar el donativo',
                'data' => $donation
            ];
        } else  {
            return [
                'success' => false,
                'message' => 'Estado de donativo inválido'
            ];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        $donation -> delete();
        return [
            'success' => true,
            'message' => 'Donativo eliminado',
            'data' => $donation
        ];
    }
}
