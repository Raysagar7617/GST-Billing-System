<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorInvoice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Hello from vendor invoice";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor-invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       # Check for existing client (vendor)
       $party = DB::table('parties')
                    ->where('party_type', 'vendor')
                    ->where(['fullname' => $request->fullname, 'phone_no' => $request->phone_no])
                    ->first();
                    
            if (!empty($party)) {
                $party_id = $party->id;
            } else {
                # Create new party
                $param = array(
                    'party_type' => 'vendor',
                    'fullname' => $request->fullname,
                    'phone_no' => $request->phone_no,
                    'address' => $request->address,
                    'account_holder_name' => $request->account_holder_name,
                    'account_no' => $request->account_no,
                    'bank_name' => $request->bank_name,
                    'ifsc_code' => $request->ifsc_code,
                    'branch_address' => $request->branch_address,
                );
                $party_id = DB::table('parties')->insertGetId($param);
            }

            # Create vendor invoice
            $param = array(
                'party_id' => $party_id,
                'account_holder_name' => $request->account_holder_name,
                'account_no' => $request->account_no,
                'bank_name' => $request->bank_name,
                'ifsc_code' => $request->ifsc_code,
                'branch_address' => $request->branch_address,
                'item_description' => $request->item_description,
                'total_amount' => $request->total_amount,
                'declaration' => $request->declaration,
                'invoice_date' => $request->invoice_date,
                'created_at' => date("Y-m-d H:i:s")
            );
            $invoice_id = DB::table('vendor_invoices')->insertGetId($param);
            if ($invoice_id) {
                return redirect()->route('vendor-invoice.show', [$invoice_id]);
            } else {
                return redirect()->back()->withError("Something went wrong, please try again");
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = DB::table('vendor_invoices')->where('id', $id)->first();
        
        return view('vendor-invoice.print', ["data"=>$invoice]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
