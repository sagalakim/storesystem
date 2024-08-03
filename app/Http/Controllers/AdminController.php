<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function store(Request $request){
        if($request->ajax()){

            $request->validate([
                'itemname' => 'required',
                'quantity' => 'required',
                'wholesale' => 'required',
                'retail' => 'required',
            ]);

            Item::create([
                'item_name' => $request->itemname,
                'quantity' => $request->quantity,
                'wholesale_price' => $request->wholesale,
                'retails_price' => $request->retail,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            $item = Item::findOrFail($request->itemid);

            $item->item_name = $request->itemname;
            $item->quantity = $request->quantity;
            $item->wholesale_price = $request->wholesale;
            $item->retails_price = $request->retail;

            $item->save();

            return response()->json(['success' => true]);
        }
    }

    public function sales()
    { //STILL FIXING THE TOTAL PROFITTTTTTT!!!!!
        $sales = SoldItem::whereDate('created_at', Carbon::today()->setTimezone('Asia/Manila'))->get();
        $itemsold = SoldItem::whereDate('created_at', today())->sum('quantity');
        $salesgot = SoldItem::whereDate('created_at', today())->sum('total');
        $totalProfit = 0;
    
        foreach ($sales as $sale) {
            $item = Item::findOrFail($sale->item_id);
            $totalProfit += $sale->total - ($item->wholesale_price * $sale->quantity);
        }
    
        return view('sales', compact('sales', 'itemsold', 'salesgot', 'totalProfit'));
    }

    public function salesweek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->setTimezone('Asia/Manila');
    
        $sales = SoldItem::whereDate('created_at', '>=', $startOfWeek)->get();
        $itemsSold = $sales->sum('quantity');
        $salesTotal = $sales->sum('total');
    
        $totalProfit = $sales->reduce(function ($carry, $sale) {
            $item = Item::findOrFail($sale->item_id);
            return $carry + ($sale->total - ($item->wholesale_price * $sale->quantity));
        }, 0);
    
        return view('salesweek', compact('sales', 'itemsSold', 'salesTotal', 'totalProfit'));
    }

    public function salesmonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->setTimezone('Asia/Manila');
    
        $sales = SoldItem::whereDate('created_at', '>=', $startOfMonth)->get();
        $itemsSold = $sales->sum('quantity');
        $salesTotal = $sales->sum('total');
    
        $totalProfit = $sales->reduce(function ($carry, $sale) {
            $item = Item::findOrFail($sale->item_id);
            return $carry + ($sale->total - ($item->wholesale_price * $sale->quantity));
        }, 0);
    
        return view('salesmonth', compact('sales', 'itemsSold', 'salesTotal', 'totalProfit'));
    }

    public function orders(){
        return view('order');
    }

    public function inventory(){
        $itemlist = Item::orderBy('item_name', 'asc')->get();
        return view('inventory', compact('itemlist'));
    }

    public function search(Request $request){
        $query = $request->get('query');
        $filterResult = Item::where('item_name', 'like', '%'. $query . '%')->get()->pluck('item_name');;
        return response()->json($filterResult);
    }

    public function sold(Request $request){
        date_default_timezone_set('Asia/Manila');
        $totalitems = 0;
        $itemsnostock = [];
        for ($i=0; $i < count($request->item); $i++) {
            $items = Item::where('item_name', 'like', '%'. $request->item[$i] . '%')->get();
            foreach ($items as $item) {
                if ($item->quantity >= $request->quantity[$i]) {
                    $item->quantity -= $request->quantity[$i];
                    $item->save();

                    SoldItem::create([
                        'item_id' => $item->id,
                        'quantity' => $request->quantity[$i],
                        'total' => $request->quantity[$i] * $item->retails_price,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
                else {
                    array_push($itemsnostock, $item->item_name);
                }
            }
            $totalitems += $request->quantity[$i];
        }
        return redirect()->back()->with('success', $itemsnostock);
    }
};
