<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function ship(Request $request, $Id)
    {
        $user = Order::findOrFail($Id);

        // Ship order...

        Mail::to($request->user())->send(new OrderShipped($user));
    }
}