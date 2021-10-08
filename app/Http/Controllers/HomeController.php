<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\RoleAccess;
Use Alert;
use App\Category;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\OrderTable;
use App\OtDetail;
use App\ShoppingCart;
use App\Table;
use App\TableCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //Trang chủ
    public function index(){
        return view('home.index');
    }

    //Trang xử lí đăng ký
    public function post_sign_up(Request $request){
        $this->validate($request,[
            'user_name'=>'unique:users,user_name'
        ],[
            'user_name.unique'=>'Tên tài khoản đã tồn tại!'
        ]
        );

        $add_sign_up = new User();
        $add_sign_up->role_id  = 3;
        $add_sign_up->full_name = $request->input('full_name');
        $add_sign_up->user_name = $request->input('user_name');
        $add_sign_up->password = bcrypt($request->input('password'));
        $add_sign_up->email = $request->input('email');
        $add_sign_up->address = $request->input('address');
        $add_sign_up->phone = $request->input('phone');
        
        $add_sign_up->save();

        return redirect('page-login')->with('alert', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập ');
    }

    //Hàm xử lí đăng nhập
    public function post_login(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');

        if(Auth::attempt(['user_name' => $user_name, 'password' => $password, 'role_id' => 3])){
            return redirect('/')->with('message1','');
        }else{
            $message = $request->session()->get('message2');
            return redirect()->back()->with('message2','');
        }
    }

    // Hàm xử lí đăng xuất
    public function logout(){
        Auth::logout();
        return redirect('page-login');
    }

    //Trang đăng ký
    public function page_sign_up(){
        return view('home.page_sign_up');
    }

    //Trang đăng nhập
    public function page_login(){
        return view('home.page_login');
    }

    //Trang giỏ hàng
    public function page_cart($id_user){
        $show_carts = ShoppingCart::where('user_id',$id_user)->get();
        return view('home.page_cart',['show_carts'=> $show_carts]);
    }
    
    //=================THÔNG TIN KHÁCH HÀNG ===============//
    //Trang hồ sơ khách hàng
    public function page_profile(){
        return view('home.profile_user.page_profile');
    }

    //Trang thay đổi thông tin khách hàng
    public function page_edit_user($id_user){
        $edit_user = User::find($id_user);
        return view('home.profile_user.page_edit_user', ['edit_user'=>$edit_user]);
    }


    //Trang đổi mật khẩu người dùng
    public function page_change_password()
    {
        return view('home.profile_user.change_password');
    }

    //HÀM ĐỔI MẬT KHẨU NGƯỜI DÙNG
    public function update_password(Request $request, $id_user)
    {
        $users = DB::table('users')->where('id', $id_user)->get();

        $old_pass = $request->input('inputPassOld');
        $new_pass = $request->input('inputPassNew');
        $new_pass_confirm = $request->input('inputPassComfirm');

        $change = User::find($id_user);

        foreach($users as $val_users){
            //Lấy mật khẩu trong DB lưu vào biến
            $db_pass = $val_users->password;

            if(password_verify($old_pass,$db_pass)){
                if($new_pass == $new_pass_confirm){
                    $change->password = bcrypt($request->input('inputPassComfirm'));
                    $change->save();
                    return redirect()->back()->with('message','');
                }else{
                    return redirect()->back()->with('message1','');
                }
            }else{
                return redirect()->back()->with('message2','');
            }
        }
    }

    //Trang chờ xác nhận
    public function page_wait_payment($id_user){
        $show_orders = Order::where([['user_id', $id_user], ['order_status', 0]])->latest()->paginate(2);
        return view('home.profile_user.wait_payment', ['show_orders'=>$show_orders]);
    }

    //Trang chờ đang giao hàng
    public function page_shipping($id_user){
        $show_orders = Order::where([['user_id', $id_user], ['order_status', 1]])->latest()->paginate(2);
        return view('home.profile_user.page_shipping', ['show_orders'=>$show_orders]);
    }

    //Trang chờ đã giao hàng
    public function page_complete($id_user){
        $show_orders = Order::where([['user_id', $id_user], ['order_status', 2]])->latest()->paginate(2);
        return view('home.profile_user.page_complete', ['show_orders'=>$show_orders]);
    }

    //Trang đã hủy
    public function page_cancelled($id_user){
        $show_orders = Order::where([['user_id', $id_user], ['order_status', 3]])->latest()->paginate(2);
        return view('home.profile_user.page_cancelled', ['show_orders'=>$show_orders]);
    }

    //Hàm cập nhật số lượng sp trong giỏ hàng
    public function update_cart(Request $request,$id_user,$id_cart){
        //Lấy id_cart và id_user
        $get_cart_user = ShoppingCart::where([['id','=',$id_cart],['user_id','=',$id_user]])->first();
        //Lấy id cart vừa nhận
        $get_cart = $get_cart_user->id;
        //Lấy id sản phẩm sau đó lấy số lượng
        $get_product = Product::where('id',$get_cart_user->product_id)->first();
        $get_qty_pro = $get_product->product_quantity;
        //Lấy số lượng input request
        $get_qty = $request->input('quantity');
        if($get_qty > $get_qty_pro){
            return redirect()->back()->with('alert','Số lượng sản phẩm không đủ');
        }else{
            $update_cart = ShoppingCart::find($get_cart);
            $update_cart->quantity = $request->input('quantity');
            $update_cart->save();
            return redirect()->back();
        }
    }

    //Hàm thêm sản phẩm vào giỏ hàng
    public function add_cart($id_user,$id_product){
        //Tìm xem có tồn tại sản phẩm trong giỏ hàng chưa
        $get_cart = ShoppingCart::where([['product_id','=',$id_product],['user_id','=',$id_user]])->first();
        if(isset($get_cart)){
            $get_id = $get_cart->id;
            $update_cart = ShoppingCart::find($get_id);
            $update_cart->quantity = $update_cart->quantity + 1;
            $update_cart->save();
            return redirect()->back()->with('message','');
        }else {
            $add_cart = new ShoppingCart();
            $add_cart->user_id = $id_user;
            $add_cart->product_id = $id_product;
            $add_cart->quantity = 1;
            $add_cart->save();
            return redirect()->back()->with('message','');
        }
   }

   //Hàm xóa sản phẩm trong giỏ hàng
   public function delete_product_cart($id_cart){
       ShoppingCart::where('id',$id_cart)->delete();
       return redirect()->back()->with('cart','');
   }
   
   //Hàm thanh toán đơn hàng
   public function checkout_payment(Request $request, $id_user){
        //Thêm hóa đơn mới
        $add_order = new Order();
        $add_order->user_id = $id_user;
        $add_order->order_status = 0;
        $add_order->order_payment = $request->input('method');
        $add_order->save();
        //Lấy đơn hàng mới nhất
        $get_order_max = DB::table('orders')->max('id');
        //Lấy giỏ hàng của user 
        $get_carts = ShoppingCart::where('user_id',$id_user)->get();
        //Xử lí trong hóa đơn chi tiết
        foreach($get_carts as $get_cart){
            //Lấy id sản phẩm để truy xuất giá sp
            $get_prices = Product::where('id',$get_cart->product_id)->first();
            //Thêm vào Order-Details
            $add_detail = new OrderDetail();
            $add_detail->order_id = $get_order_max;
            $add_detail->product_id = $get_cart->product_id;
            $add_detail->total_quantity = $get_cart->quantity;
            $add_detail->total_price = ($get_cart->quantity * $get_prices->product_price);
            $add_detail->save();
            //Lấy số lượng giỏ hàng và sản phẩm
            $get_qty_cart = $get_cart->quantity;
            $get_qty = $get_prices->product_quantity;
            //Lấy số lượng sản phẩm trừ giỏ hàng
            if($get_prices->category_id == 1){
                foreach($get_prices as $get_price){
                    $quantity = ($get_qty - $get_qty_cart);
                    DB::table('products')->where('category_id',1)->update(['product_quantity'=> $quantity]);
                }
            }else{
                $quantity = ($get_prices->product_quantity - $get_qty_cart);
                //Cập nhật lại số lượng
                DB::table('products')->where('id',$get_cart->product_id)->update(['product_quantity'=> $quantity]);
            }
        }
        DB::table('shopping_carts')->where('user_id',$id_user)->delete();
        return redirect('page-wait-payment/'.$id_user)->with('alert','Đặt hàng thành công!!!');
   }

    //Trang thanh toán
    public function page_checkout($id_user){
        $show_carts = ShoppingCart::where('user_id',$id_user)->get();
        return view('home.page_checkout',['show_carts'=>$show_carts]);
    }

    //Trang menu
    public function page_category(){
        $show_cates = DB::table('categories')->get();
        return view('home.page_category',['show_cates' => $show_cates]);
    }

    //Thanh sản phẩm
    public function page_product($category_name,$id_category){
        $category_id = Category::find($id_category);
        $show_products = Product::where('category_id',$id_category)->latest()->get();
        return view('home.page_product',
        [
            'category_id'=>$category_id,
            'show_products'=>$show_products
        ]);
    }


    //Trang đặt bàn
    public function page_table(){
        $show_tables = DB::table('tables')->get();
        return view('home.order_table.page_table',['show_tables'=>$show_tables]);
    }

    //Trang table cart
    public function page_table_cart($id_table){
        $id = $id_table;
        $find_table = TableCart::where('table_id',$id)->first();
        if(isset($find_table)){
            $show_table_carts = TableCart::where('table_id',$id_table)->get();
            return view('home.order_table.page_table_cart',[
                'show_table_carts'=>$show_table_carts,
                'id'=>$id
            ]);
        }else{
            // Show giỏ hàng của bàn đã chọn
            $show_table_carts = TableCart::where('table_id',$id_table)->get();
            return view('home.order_table.page_table_cart',[
                'show_table_carts'=>$show_table_carts,
                'id'=>$id
            ]);
        }
    } 

    //Trang Table_Category
    public function page_table_category($id_table){
        $id = $id_table;
        $show_cates = DB::table('categories')->get();
        return view('home.order_table.page_table_category',[
            'show_cates' => $show_cates,
            'id'=>$id
        ]);
    }

    //Trang Table_Product
    public function page_table_product($id_category,$id_table){
        $id = $id_table;
        $category_id = Category::find($id_category);
        $show_products = Product::where('category_id',$id_category)->latest()->get();
        return view('home.order_table.page_table_product',
        [
            'id'=>$id,
            'category_id'=>$category_id,
            'show_products'=>$show_products
        ]);
    }

    //HÀM THÊM SẢN PHẨM VÀO TABLE CART
    public function add_table_cart($id_product,$id_table){
        $get_carts = TableCart::where([['product_id','=',$id_product],['table_id','=',$id_table]])->first();
        //Tìm xem đã tồn tại sp trong table cart chưa
        if(isset($get_carts)){
            $get_id = $get_carts->id;
            $update_cart = TableCart::find($get_id);
            $update_cart->tc_quantity = $update_cart->tc_quantity + 1;
            $update_cart->save();
            return redirect()->back()->with('message','');
        }else{
            $add_cart = new TableCart();
            $add_cart->table_id = $id_table;
            $add_cart->product_id = $id_product;
            $add_cart->tc_quantity = 1;
            $add_cart->save();
            DB::table('tables')->where('id',$id_table)->update(['table_status'=> 1]);
            return redirect()->back()->with('message','');
        }
    }

    //HÀM XÓA SẢN PHẨM TRONG TABLE_CART
    public function delete_product_tc($id_tc){
        TableCart::where('id',$id_tc)->delete();
       return redirect()->back()->with('message','');
    }

    //HÀM HỦY TABLE_CART
    public function cancel_table_cart($id_table){
        TableCart::where('table_id',$id_table)->delete();
        DB::table('tables')->where('id',$id_table)->update(['table_status'=> 0]);
        return redirect('page-table')->with('alert','Hủy bàn thành công!');
    }

    //HÀM THANH TOÁN TABLE CART
    public function post_table_cart(Request $request,$id_table){
        //Thêm hóa đơn mới
        $add_ot = new OrderTable();
        $add_ot->ot_status = 0;
        $add_ot->ot_payment = 0;
        $add_ot->save();
        //Lấy đơn hàng mới nhất
        $get_ot = DB::table('order_tables')->max('id');
        //Lấy giỏ hàng của table
        $get_carts = TableCart::where('table_id',$id_table)->get();
        //Xử lí trong ot detail
        foreach($get_carts as $get_cart){
            //Lấy id sp để truy xuất giá
            $get_products = Product::where('id',$get_cart->product_id)->first();
            $price = $get_products->product_price;
            //Thêm vào ot details
            $add_otd = new OtDetail();
            $add_otd->ot_id = $get_ot;
            $add_otd->product_id = $get_products->id;
            $add_otd->ot_quantity = $request->input('inputQty');
            $add_otd->ot_price = $price * $add_otd->ot_quantity;
            $add_otd->save();
            //Lấy sổ lượng sp trong table cart và trong kho
            $qty_cart = $add_otd->ot_quantity;
            $get_qty = $get_products->product_quantity;
            //Trừ tồn kho => nếu là gà rán thì trừ hết cate (dùng foreach), còn lại trừ đúng 1 id và cập nhật số lượng
            if($get_products->category_id == 1){
                foreach($get_products as $get_product){
                    $quantity = ($get_qty - $qty_cart);
                    DB::table('products')->where('category_id',1)->update(['product_quantity'=> $quantity]);
                }
            }else{
                $quantity = ($get_qty - $qty_cart);
                DB::table('products')->where('id',$get_products->id)->update(['product_quantity'=> $quantity]);
            }
        }
        //Xóa giỏ hàng và trả lại trang đặt bàn
        DB::table('table_carts')->where('table_id',$id_table)->delete();
        //Cập nhật lại table status
        DB::table('tables')->where('id',$id_table)->update(['table_status'=> 0]);
        return redirect('page-table')->with('alert','Thanh toán thành công!!!');
    }

    public function search(Request $request){
        
    }
}
