<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\InvoicesProducts;
use Illuminate\Http\Request;
use Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $invoices = Invoices::where('user_id',$user->id)->with('InvoicesProducts')->orderBy('id','desc')->get();
        return response()->json(['status'=>200,'invoices'=>$invoices],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $invoice = new Invoices();

        $invoice->date_hourly = $request->date_hourly;
        $invoice->name_emitter = $request->name_emitter;
        $invoice->NIT_emitter = $request->NIT_emitter;
        $invoice->name_buyer = $request->name_buyer;
        $invoice->NIT_buyer = $request->NIT_buyer;
        $invoice->before_IVA = $request->before_IVA;
        $invoice->IVA = $request->IVA;
        $invoice->total_value = $request->total_value;
        $invoice->quantity = $request->quantity;
        $invoice->user_id = $user->id;
        $invoice->save();

        $invoiceSaved = Invoices::latest('id')->first();
        foreach ($request->products as $key => $product) {            
            $invoice_product = new InvoicesProducts();
            $invoice_product->id_invoice = $invoiceSaved->id;
            $invoice_product->id_product = $product['id'];
            $invoice_product->save();
        }

        return response()->json(['status'=>200, 'message'=>'Factura Creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateInvoice = Invoices::findOrFail($id);        
        $updateInvoice->date_hourly = $request->date_hourly;
        $updateInvoice->name_emitter = $request->name_emitter;
        $updateInvoice->NIT_emitter = $request->NIT_emitter;
        $updateInvoice->name_buyer = $request->name_buyer;
        $updateInvoice->NIT_buyer = $request->NIT_buyer;
        $updateInvoice->before_IVA = $request->before_IVA;
        $updateInvoice->IVA = $request->IVA;
        $updateInvoice->total_value = $request->total_value;
        $updateInvoice->quantity = $request->quantity;

        $updateInvoice->update();        
        foreach ($request->products as $key => $product) {
            $invoice_product = InvoicesProducts::where('id_invoice',$id)->where('id_product',$product['id'])->first();
            if($invoice_product){
                $invoice_product->id_invoice = $id;
                $invoice_product->id_product = $product['id'];
                $invoice_product->save();
            }else{
                $invoice_product = new InvoicesProducts();
                $invoice_product->id_invoice = $id;
                $invoice_product->id_product = $product['id'];
                $invoice_product->save();
            }           
        }
        
        return response()->json(['status'=>200, 'message'=>'Factura Actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
