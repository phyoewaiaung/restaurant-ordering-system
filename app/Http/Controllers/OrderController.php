<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tables = Table::all();
        $dishes = Dish::orderby('id','desc')->get();
        $status = array_flip(config('res.order_status'));
        $orders = Order::where('status',4)->get();
        return view('order_form',compact('dishes','tables','orders','status'));
    }
    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token','table'));
        $orderId = mt_rand(1111,9999);
        foreach($data as $key => $value){
            if($value > 1){
                for ($i=0; $i < $value; $i++) {
                    $order = new Order();
                    $order->order_id = $orderId;
                    $order->dish_id = $key;
                    $order->table_id = $request->table;
                    $order->status = config('res.order_status.new');

                    $order->save();
                }
            }else{
                $order = new Order();
                $order->order_id = $orderId;
                $order->dish_id = $key;
                $order->table_id = $request->table;
                $order->status = config('res.order_status.new');

                $order->save();
            }
        }
        return Redirect()->back()->with('message','Order Submitted');
    }
    public function serve(Order $order)
    {
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with('message','Order serve to customer');
    }
}
