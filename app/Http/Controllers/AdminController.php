<?php

namespace App\Http\Controllers;


use App\Category;
use App\Combo;
use App\ComboProduct;
use App\Comment;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductSupplier;
use App\RoleAccess;
use App\TableArea;
use App\Slider;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    //Trang admin
    public function page_admin(){
        $show_order_lastests = Order::where('order_status',0)->take(5)->get();
        if((Auth::check() && Auth::user()->role_id == 1) || Auth::check() && Auth::user()->role_id == 2){
            return view('admin.index_admin',['show_order_lastests'=>$show_order_lastests]);
        }else{
            return redirect('login-admin');
        }
    }

    //Trang đăng nhập quản trị viên
    public function login_admin(){
        return view('admin.login_admin');
    }

    //Hàm kiểm tra đăng nhập
    public function check_login(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');
        
        if(Auth::attempt(['user_name' => $name, 'password' => $password, 'role_id' => 1])){
            return redirect('page-admin');
        }else if(Auth::attempt(['user_name' => $name, 'password' => $password, 'role_id' => 2])){
            return redirect('page-admin');
        }else{
            return redirect()->back()->with('message','');
        }
    }

    //Hàm đăng xuất
    public function logout_admin(){
        Auth::logout();
        return redirect('login-admin');
    }
    //===================QUẢN LÝ THÔNG TIN ADMIN - NHÂN VIÊN ===========================//
    //==================================================================================//
    //==================================================================================//
    //Hồ sơ quản trị viên
    public function profile_admin($id_user){
        $infor_user = User::find($id_user);
        return view('admin.profile_admin.edit_profile',['infor_user'=>$infor_user]);
    }

    //Cập nhật thông tin cá nhân
    public function update_profile(Request $request, $id_user)
    {
        $update_profile = User:: find($id_user);
        $update_profile->full_name = $request->input('inputFullname');
        $update_profile->email = $request->input('inputEmail');
        $update_profile->phone = $request->input('inputPhone');
        $update_profile->gender = $request->input('inputSex');
        $update_profile->address = $request->input('inputAddress');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $update_profile->avatar = $image_name;
        }
        $update_profile->save();

        return redirect()->back()->with('message','Đã cập nhật thông tin');
    }

    //Trang đổi mật khẩu quản trị viên
    public function change_pass($id_user)
    {
        $user_ids = User::find($id_user);
        return view('admin.profile_admin.change_pass',['user_ids'=>$user_ids]);
    }

    //Hàm đổi mật khẩu quản trị viên
    public function update_change_password(Request $request, $id_user)
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

                    $mes = session()->get('mes');
                    return redirect()->back()->with('mes','');
                }else{
                    return redirect()->back()->with('message_error_pass_old_comfirm','Xác nhận mật khẩu sai!');
                }
            }else{
                return redirect()->back()->with('message_error_pass_old','Mật khẩu cũ không đúng!');
            }
        }
    }

    //=======================QUẢN LÝ NGƯỜI DÙNG=========================================//
    //==================================================================================//
    //==================================================================================//
    //Hàm hiển thị trang quyền truy cập
    public function page_role_access()
    {
        $show_user_roles = User::latest()->paginate(5);
        return view('admin.user_manage.role_access',['show_user_roles'=>$show_user_roles]);
    }

    //HÀM THÊM QUYỀN TRUY CẬP
    public function post_add_role_access(Request $request)
    {
        $this->validate($request,[
            'inputRoleName'=>'unique:role_accesses,role_name'
        ],[
            'inputRoleName.unique'=>'Tên quyền đã tồn tại'
        ]);

        $add_role_access = new RoleAccess();
        $add_role_access->role_name = $request->input('inputRoleName');
        $add_role_access->role_describe = $request->input('inputDescript');
        $add_role_access->save();

        return redirect()->back()->with('message','Đã thêm quyền truy cập mới!');
    }

    //Hàm hiển thị trang thay đổi quyền
    public function page_change_role($id_role)
    {
        $role_ids = User::find($id_role);
        return view('admin.user_manage.change_role',['role_ids'=>$role_ids]);
    }

    //Hàm hiển thị trang thay đổi quyền
    public function update_role(Request $request, $id_role)
    {
        $update_role = User::find($id_role);
        $update_role->role_id = $request->input('inputRoleId');
        $update_role->save();

        return redirect('page-role-access')->with('message','Đã thay đổi quyền');
    }


    //HÀM HIỂN THỊ TRANG QUẢN TRỊ
    public function page_administation()
    {
        $show_admins = User::where('role_id',1)->latest()->paginate(5);
        return view('admin.user_manage.administation',['show_admins'=>$show_admins]);
    }

    //Trang thêm quản trị
    public function page_add_admin()
    {
        return view('admin.user_manage.add_admin');
    }

    //HÀM THÊM MỚI ADMIN-NHÂN VIÊN CSDL
    public function post_admin(Request $request)
    {
        //Thực hiện thứ nhát
        $this->validate($request,[
            'inputUserName'=>'unique:users,user_name',
            'inputEmail'=>'unique:users,email',
        ],[
            'inputUserName.unique'=>'Tên tài khoản đã tồn tại',
            'inputEmail.unique'=>'Email đã tồn tại'
        ]);

        $add_admin = new User();
        $add_admin->role_id = $request->input('inputRoleId');
        $add_admin->full_name = $request->input('inputFullName');
        $add_admin->user_name = $request->input('inputUserName');
        $add_admin->password = bcrypt($request->input('inputPassword')); //Mã hóa mật khẩu
        $add_admin->email = $request->input('inputEmail');
        $add_admin->address = $request->input('inputAddress');
        $add_admin->phone = $request->input('inputPhoneNumber');
        $add_admin->gender = $request->input('inputSex');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $add_admin->avatar = $image_name;
        }
        $add_admin->save();

        //Thực hiện thứ 2
        $latest_user = DB::table('users')->latest()->first();
        if ($latest_user->role_id == 1) {
            return redirect('page-administation')->with('message1','');
        }elseif ($latest_user->role_id == 2){
            return redirect('page-customer')->with('message1','');
        }
        else{
            return redirect('page-employee')->with('message1','');
        }
    }

    //HÀM HIỂN THỊ TRANG NHÂN VIÊN LẤY TỪ CSDL
    public function page_employee()
    {
        $show_employee = User::where('role_id', 2)->latest()->paginate(5);
        return view('admin.user_manage.employee',['show_employee'=>$show_employee]);
    }

    //HÀM XÓA TRANG NHÂN VIÊN
    public function delete_employee($id_employee)
    {
        User::destroy($id_employee);
        return redirect()->back()->with('message','Đã xóa nhân viên');
    }

    //HÀM HIỂN THỊ TRANG KHÁCH HÀNG
    public function page_customer()
    {
        $show_customer = User::where('role_id',3)->latest()->paginate(5);
        return view('admin.user_manage.customer',['show_customer'=>$show_customer]);
    }

    //HÀM XÓA TRANG KHÁCH HÀNG
    public function delete_customer($id_customer)
    {
        User::destroy($id_customer);
        return redirect()->back()->with('message','Đã xóa khách hàng');
    }
    

    //=========================== TRANG QUẢN LÝ SẢN PHẨM ===============================//
    //==================================================================================//
    //==================================================================================//
    
    //TRANG LOẠI SẢN PHẨM
    public function page_category_product()
    {
        $show_categories = Category::latest()->paginate(5);
        return view('admin.product_manage.category_product',['show_categories'=>$show_categories]);
    }

    //HÀM THÊM LOẠI SẢN PHẨM
    public function post_add_category(Request $request){
        $this->validate($request,[
            'inputCategory'=>'unique:categories,category_name',
        ],[
            'inputCategory.unique'=>'Tên loại đã tồn tại',
        ]);

        $add_category = new Category();
        $add_category->category_name = $request->input('inputCategory');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $add_category->category_image = $image_name;
        }

        $add_category->save();

        return redirect()->back()->with('message1','Đã thêm loại sản phẩm');
    }

    //HÀM XÓA LOẠI SẢN PHẨM
    public function delete_category($id_category)
    {
        Category::where('id','=',$id_category)->delete();
        return redirect()->back()->with('message','Đã xóa loại sản phẩm');
    }

    //HÀM HIỂN THỊ DANH SÁCH SẢN PHẨM CSDL
    public function page_list_product(){
        $show_products = Product::latest()->paginate(5);
        return view('admin.product_manage.list_product',['show_products'=>$show_products]);
    }

    //Hàm thêm sản phẩm
    public function post_product(Request $request){
        $add_product = new Product();
        $add_product->category_id = $request->input('inputCategoryId');
        $add_product->product_name = $request->input('inputName');
        $add_product->product_quantity = $request->input('inputQuantity');
        $add_product->product_price = $request->input('inputPrice');
        $add_product->product_discount = 0;
        $add_product->unit_price = $request->input('inputUnitPrice');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $add_product->product_img = $image_name;
        }
        $add_product->save();

        // Thực hiện 3
        $max_id_product = DB::table('products')->max('id');

        //Thực hiện 4
        $add_pro_sup = new ProductSupplier();
        $add_pro_sup->product_id = $max_id_product;
        $add_pro_sup->supplier_id= $request->input('inputSupplier');
        $add_pro_sup->save();

        return redirect('page-list-product')->with('message1','');
    }

    //them chi tiet sp
    // public function add_pdetail(){

    //     return view('admin.product_manage.add_dproduct');

    // }

    //HÀM XÓA SẢN PHẨM
    public function delete_product($id_product){
        Product::where('id','=',$id_product)->delete();
        return redirect()->back()->with('message','Đã xóa sản phẩm thành công!');
    }

    //Hàm chỉnh sửa sản phẩm
    public function edit_product($id){
        $infor_product = Product::find($id);
        $get_ps = ProductSupplier::where('product_id',$id)->first();
        return view('admin.product_manage.edit_product', [
            'infor_product'=>$infor_product,
            'get_ps'=>$get_ps
        ]);
    }

    //Cập nhật thông tin sản phẩm
    public function update_product(Request $request, $id_product, $id_pro_sub){
        $update_infor_product = Product:: find($id_product);
        $update_infor_product->product_name = $request->input('inputName');
        $update_infor_product->product_price = $request->input('inputPrice');
        $update_infor_product->product_quantity  = $request->input('inputQuantity');
        $update_infor_product->unit_price = $request->input('inputUnit');
        $update_infor_product->product_discount = $request->input('inputDiscount');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $update_infor_product->product_img = $image_name;
        }
        $update_infor_product->save();

        $update_pro_sup = ProductSupplier::find($id_pro_sub);
        $update_pro_sup->supplier_id = $request->input('inputSupplier');
        $update_pro_sup->save();

        return redirect('page-list-product')->with('message','Đã cập nhật thông tin sản phẩm');
    }

    //HÀM HIỂN THỊ DANH SÁCH COMBO
    public function combo_product(){
        $show_combos = Combo::latest()->paginate(5);
        return view('admin.product_manage.combo_product',['show_combos'=>$show_combos]);
    }

    //Tính giảm giá tăng
    public function increaseQty($id_combo){
        $combo = Combo::get($id_combo);
        $dis = $combo->combo_discount + 1;
        $price = $combo->combo_total_price - ($combo->combo_total_price * $dis)/100;
        Combo::updated($id_combo,$dis,$price);
    }

    //HÀM THÊM MỚI COMBO
    public function add_combo(Request $request){
        $add_combo = new Combo();
        $add_combo->combo_name = $request->input('inputName');
        $add_combo->combo_discount = $request->input('inputDiscount');
        $add_combo->combo_total_price = 0;

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $add_combo->combo_img = $image_name;
        }

        $add_combo->save();
        return redirect()->back();
    }

    //TRANG HIỂN THỊ COMBO DETAILS
    public function combo_detail($id_combo){
        $show_details = ComboProduct::where('combo_id',$id_combo)->get();
        return view('admin.product_manage.combo_detail',[
            'show_details'=>$show_details,
            'id_combo' => $id_combo
        ]);
    }

    //HÀM THÊM MỚI PRODUCT COMBO
    public function add_combo_detail($id_combo,Request $request){
        $add_cd = new ComboProduct();
        $add_cd->combo_id = $id_combo;
        $add_cd->product_id = $request->input('inputProduct');
        $add_cd->quantity_combo = $request->input('inputQuantity');
        $add_cd->save();
        //Lấy tổng giá lúc trước khi thêm
        $get_combo = DB::table('combos')->where('id',$id_combo)->first();   
        $total_original = $get_combo->combo_total_price;
        //Lấy tổng giá sản phẩm vừa mới thêm vào
        $get_id = DB::table('combo_products')->max('id');
        $get_max = DB::table('combo_products')->where('id',$get_id)->first();
        //Lấy giá sản phẩm trong kho để trừ
        $get_pro = DB::table('products')->where('id',$get_max->product_id)->first();
        $get_total = $get_max->quantity_combo * $get_pro->product_price;
        //Tính lại được giá tổng
        $update_total = $total_original + $get_total;
        DB::table('combos')->where('id',$id_combo)->update(['combo_total_price' => $update_total]);
        return redirect()->back()->with('success','Thêm thành công');
    }

    //HÀM XÓA COMBO DETAILS
    public function delete_product_combo($id_detail){
        ComboProduct::where('id','=',$id_detail)->delete();
        return redirect()->back()->with('delete','Đã xóa thành công');
    }


    //========HÀM TÌM SẢN PHẨM THEO CATEGORY AJAX=======//
    public function findProductName(Request $request){
        $data = Product::select('product_name','id')->where('category_id',$request->id)->get();
        return response()->json($data);
    }
    //==================================================//
    
    //HÀM HIỂN THỊ NHÀ CUNG CẤP
    public function product_supplier(){
        $show_suppliers = DB::table('suppliers')->latest()->paginate(5);
        return view('admin.product_manage.product_supplier',['show_suppliers'=>$show_suppliers]);
    }

    //HÀM THÊM MỚI NHÀ CUNG CẤP
    public function post_supplier(Request $request){
        $add_supplier = new Supplier();
        $add_supplier->supplier_name = $request->input('inputName');
        $add_supplier->supplier_address = $request->input('inputAddress');
        $add_supplier->supplier_describe = $request->input('inputDescribe');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $add_supplier->supplier_img = $image_name;
        }
        $add_supplier->save();

        return redirect()->back()->with('message1','');
    }

    //TRANG CHỈNH SỬA NHÀ CUNG CẤP
    public function edit_supplier($id){
        $infor_supplier = Supplier::find($id);
        return view('admin.product_manage.edit_supplier',['infor_supplier' =>$infor_supplier]);
    }

    //HÀM CẬP NHẬT NHÀ CUNG CẤP
    public function update_supplier(Request $request,$id_sup){
        $update_sup = Supplier::find($id_sup);
        $update_sup->supplier_name = $request->input('inputName');
        $update_sup->supplier_address = $request->input('inputAddress');
        $update_sup->supplier_describe = $request->input('inputDescribe');

        if($request->hasFile('inputFileImage')){
            $image = $request->file('inputFileImage');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('home/upload_img'), $image_name);
            $update_sup->supplier_img = $image_name;
        }
        $update_sup->save();
        return redirect('product-supplier')->with('message','Đã cập nhật thông tin nhà cung cấp');
    }
    //HÀM XÓA NHÀ CUNG CẤP
    public function delete_supplier($id_supplier)
    {
        Supplier::where('id','=',$id_supplier)->delete();
        return redirect()->back()->with('message','Đã xóa nhà cung cấp thành công!');
    }

    //=================TRANG QUẢN LÝ HÓA ĐƠN ===================//  
    //Trang quản lý hóa đơn
    public function admin_order()
    {
        $show_orders = Order::latest()->paginate(5);
        return view('admin.order_manage.admin_order',['show_orders' => $show_orders]);
    }

    //Hàm duyệt đơn hàng
    public function approve_order($id)
    {
        Order::where('id', $id)->update(['order_status'=>1]);
        return redirect()->back();
    }

    //Xác nhận đã giao hàng
    public function confirm_order($id){
        Order::where('id', $id)->update(['order_status'=>2]);
        return redirect()->back();
    }

    //Hàm hủy đơn hàng
    public function cancel_order($id){
        Order::where('id', $id)->update(['order_status'=>3]);
        $get_details = OrderDetail::where('order_id',$id)->get();
        foreach( $get_details as $get_detail){
            $get_qty = Product::where('id',$get_detail->product_id)->first();
            //Lấy số lượng trong kho
            $quantity = $get_qty->product_quantity;
            //Lấy số lượng trong hóa đơn
            $qty = $get_detail->total_quantity;
            //Cộng lại vào sản phẩm ban đầu
            $result = $quantity + $qty;
            DB::table('products')->where('id',$get_detail->product_id)->update(['product_quantity'=> $result]);
        }
        
        return redirect()->back()->with('message','');
    }

    //Hàm hóa đơn chi tiết
    public function admin_order_detail($id)
    {
        $show_order = Order::find($id);
        return view('admin.order_manage.admin_order_detail',['show_order'=>$show_order]);
    }

    //Hàm xuất hóa đơn
    public function export_order($id)
    {
        $show_export = Order::find($id);
        return view('admin.order_manage.export_order',['show_export'=>$show_export]);
    }

    
}
