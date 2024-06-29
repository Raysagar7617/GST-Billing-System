<?php

namespace App\Http\Controllers;
use App\Models\Party;
use App\Models\GstBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GstBillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addGstBill()
    {
        $party = Party::where('party_type','client')->orderBy('fullname')->get();
        return view("gst-bill.add",['party'=>$party]);
    }

    public function index()
    {
        $gstbill = GstBill::with('party')->get();
       
        return view("gst-bill.index",['bills'=>$gstbill]);
    }
    public function print($id)
    {
        $bill = GstBill::where('id',$id)->with('party')->first();
        return view("gst-bill.print",['bill'=>$bill]);
    }
    
    public function createGstBill(Request $request)
    {
         $request->validate([
            'party_id'=>'required|exists:parties,id',
            'invoice_date'=>'required|date',
            'invoice_no'=>'required|string|max:255',
            'item_description'=>'required|max:250',
            'total_amount'=>'required|numeric',
            'cgst_rate'=>'nullable|min:0|max:100',
            'cgst_amount'=>'numeric|min:0',
            'sgst_rate'=>'nullable|min:0|max:100',
            'sgst_amount'=>'numeric|min:0',
            'igst_rate'=>'nullable|min:0|max:100',
            'igst_amount'=>'numeric|min:0',
            'tax_amount'=>'numeric|min:0',
            'net_amount'=>'required|numeric|min:0'

         ]);
         
         $param = $request->input();
         unset($param['_token']);
         
        GstBill::create($param);
        
        return redirect()->route('manage-gst-bills')->withStatus('Bill created Successfully');
        
    }
    public function deleteGstBill($id)
    {
        $user  =GstBill::find($id);
        $user->delete();
        return redirect()->back()->withStatus('Record deleted successfully');
    }

}
