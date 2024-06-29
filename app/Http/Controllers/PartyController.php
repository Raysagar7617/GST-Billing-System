<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Party;

class PartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $party = Party::all();
        return view("party.index",['data'=>$party]);
    }

    public function addParty()
    {
        return view("party.add");
    }
    
    public function createParty(Request $request)
    {
         
      $request->validate([
         "party_type"=> "required",
         "fullname"=>"required|string|min:2|max:20",
         "phone_no"=>"required|numeric|min:10",
         "address"=>"required|max:255",
         "account_holder_name"=>"required|string|min:2|max:20",
         "account_no" =>"required|numeric",
         "bank_name"=>"required|string",
         "ifsc_code"=>"required|max:10",
         "branch_address"=>"required|max:255"
      ]);
      

        $party = new Party();
        $party->party_type = $request->party_type;
        $party->fullname = $request->fullname;
        $party->phone_no = $request->phone_no;
        $party->address = $request->address;
        $party->account_holder_name = $request->account_holder_name;
        $party->account_no = $request->account_no;
        $party->bank_name = $request->bank_name;
        $party->ifsc_code = $request->ifsc_code;
        $party->branch_address = $request->branch_address;
        $party->save();
    
       return redirect()->route("add-party")->withStatus("Party created successfully");

    }
    public function editParty($id)
    {
        $party = Party::find($id);
    
        return view("party.edit",['party'=>$party]);
    }
    public function updateParty(Request $request)
    {
        $request->validate([
            "party_type"=> "required",
            "fullname"=>"required|string|min:2|max:20",
            "phone_no"=>"required|numeric|min:10",
            "address"=>"required|max:255",
            "account_holder_name"=>"required|string|min:2|max:20",
            "account_no" =>"required|numeric",
            "bank_name"=>"required|string",
            "ifsc_code"=>"required|max:10",
            "branch_address"=>"required|max:255"
         ]);

        $party = Party::find($request->id);
        $party->party_type = $request->party_type;
        $party->fullname = $request->fullname;
        $party->phone_no = $request->phone_no;
        $party->address = $request->address;
        $party->account_holder_name = $request->account_holder_name;
        $party->account_no = $request->account_no;
        $party->bank_name = $request->bank_name;
        $party->ifsc_code = $request->ifsc_code;
        $party->branch_address = $request->branch_address;
        $party->save();
        return redirect()->route('manage-parties')->withStatus("Party Edit successfully");   
    }
    
    public function deleteParty($id)
    {
        $party = Party::find($id);
        $party->delete();

        return redirect()->route('manage-parties')->withStatus("Deleted successfully"); 
    }
}
