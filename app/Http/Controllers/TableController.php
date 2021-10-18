<?php

namespace App\Http\Controllers;

use App\OrderTable;
use App\OtDetail;
use App\TableCart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class TableController extends Controller
{
    //Trang chọn bàn
    public function table_manage($id_area){
        $show_areas = DB::table('table_area')->get();
        if($id_area == 0){
            $show_tables = DB::table('tables')->get();
        } else{
            $show_tables = DB::table('tables')->where('area_id',$id_area)->latest()->paginate(24);
        }
        return view('order_table.table',[
            'show_areas'=> $show_areas,
            'show_tables' => $show_tables
        ]);
    }

    //Trang chọn món
    public function table_menu($id_table,$id_cate){
        $show_cates = DB::table('categories')->get();
        if($id_cate == 0){
            $show_products = DB::table('products')->latest()->paginate(8);
        } else{
            $show_products = DB::table('products')->where('category_id',$id_cate)->latest()->paginate(8);
        }
        return view('order_table.table_menu',[
            'id_table' => $id_table,
            'show_cates' => $show_cates,
            'show_products' => $show_products
        ]);
    }

    //Hàm thêm table-cart
    public function add_table_cart($id_table,$id_product){
        $check_cart = DB::table('table_carts')->where([['table_id', $id_table], ['product_id', $id_product]])->first();
        if(isset($check_cart)){
            $get_id = $check_cart->id;
            $update_cart = TableCart::find($get_id);
            $update_cart->tc_quantity = $update_cart->tc_quantity + 1;
            $update_cart->save();
        } else{
            $add_cart = new TableCart();
            $add_cart->table_id = $id_table;
            $add_cart->product_id  = $id_product;
            $add_cart->tc_quantity = 1;
            $add_cart->save();
        }

        DB::table('tables')->where('id',$id_table)->update(['table_status'=>1]);
        return redirect()->back();
    }

    //Hàm thanh toán cho table
    public function checkout_table($id_table){
        $add_ot = new OrderTable();
        $add_ot->ot_status = 1;
        $add_ot->ot_payment	= 1;
        $add_ot->save();
        //Lấy order_table vừa mới tạo
        $get_max_ot = DB::table('order_tables')->max('id');
        //Lấy id của table_cart
        $get_table_carts = DB::table('table_carts')->where('table_id',$id_table)->get();
        //Thêm chi tiết ot_detail
        foreach($get_table_carts as $get_table_cart){
            $add_detail = new OtDetail();
            $add_detail->ot_id = $get_max_ot;
            $add_detail->product_id = $get_table_cart->product_id;
            $add_detail->ot_quantity = $get_table_cart->tc_quantity;
            //Lấy id sp để truy xuất giá gốc và số lượng
            $get_product = DB::table('products')->where('id',$get_table_cart->product_id)->first();
            //Tính được tổng tiền từng món =  sp * sl 
            $add_detail->ot_price = $get_product->product_price * $get_table_cart->tc_quantity;
            $add_detail->save();
            //lấy số lượng sp trong kho và sp từ giỏ hàng
            $get_qty = $get_product->product_quantity;
            $get_qty_cart = $get_table_cart->tc_quantity;
            //Trường hợp đặc biệt món gà rán
            if($get_product->category_id == 1){
                foreach($get_product as $product){
                    $quantity = ($get_qty - $get_qty_cart);
                    DB::table('products')->where('category_id',1)->update(['product_quantity'=> $quantity]);
                }
            } else{
                //Trừ số lượng sp trong kho ra
                $result =  $get_qty - $get_qty_cart;
                DB::table('products')->where('id',$get_table_cart->product_id)->update(['product_quantity'=> $result]);
            }
        }
        DB::table('table_carts')->where('table_id',$id_table)->delete();
        DB::table('tables')->where('id',$id_table)->update(['table_status'=>0]);
        return redirect('table-manage/0')->with('success','Đã thanh toán');
    }

    //Hàm xóa table cart
    public function delete_table_cart($id_cart){
        TableCart::destroy($id_cart);
    }

    //Cập nhất số lượng table cart
    // public function update_table_cart(Request $request){
    //     if($request->id and $request->quantity){
    //         $oldCart = Session::has('cart')?Session::get('cart'):null;
    //         $cart = new TableCart($oldCart);
    //         $cart->update_cart($request->id,$request->tc_quantity);
    //         session()->put('cart', $cart);
    //     }
    // }
    //Cập nhật số lượng table-cart
    public function update_cart($key, $qty){
        $add_cart = TableCart::where('id',$key)->update(['tc_quantity'=>$qty]);
    }
}
