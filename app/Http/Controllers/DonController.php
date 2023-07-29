<?php

/* Telling PHP that the code in this file is part of the `App\Http\Controllers` namespace. */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
@include('sweetalert::alert');

session_start();
class DonController extends Controller
{
    public function add_don_NH(){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->limit(3)->get();
        $nhom=DB::table('nhom')->get();
        return view('admin.add_category_product')->with('loai',$loai)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }
    public function add_don_KD(){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        return view('admin.add_don_kd')->with('huyen',$huyen)
                                    ->with('congty',$congTy);
    }
    public function add_don_GPHI(){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        return view('admin.add_don_gphi')->with('huyen',$huyen)
                                    ->with('congty',$congTy);
    }

    public function all_don(Request $request){
        $search = $request->search ?? '';
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $data=$request;
        $don=DB::table('don')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->get();

        if($request->huyen!=0){
            $don=$don->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $don=$don->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $all_bang=$all_bang->where('nam',$request->nam);
        }       
        
        return view('admin.all_don')->with('don', $don)
                                    ->with('data', $data)
                                    ->with('huyen',$huyen)
                                    ->with('loai',$loai);
    }
    public function save_don_NH(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
    if($request->NguoiNop>0){
        $request->validate([
            
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'required|image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'nhom'=> 'required',
            
            
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "nhom.required"=>"Trường này không được bỏ trống",
           
           
        ]);
    }else{
        $request->validate([
            
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'required|image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'nhom'=> 'required',
            
            'tenCongTy'=> 'required',
            'diaChi'=> 'required',
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "nhom.required"=>"Trường này không được bỏ trống",
           
            "tenCongTy.required"=>"Trường này không được bỏ trống",
            "diaChi.required"=>"Trường này không được bỏ trống",
        ]);
    }
    
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        $data['don_id'] = $request->don_id;
        $data['image'] = $request->image;
        $data['ngayNop'] = $request->NgayNopDon;
        $data['ngayCongBo'] = $request->NgayCongBo;
        $data['trangThai']=0;

        $data['loai_id']=$request->loai;

        $year=Carbon::create($request->NgayCongBo)->year;
        $data['don_nam']=$year;


        $get_image = $request->file('image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload',$new_image);
            $data['image'] = $new_image;
            
        }
        for($i=0;$i<count($request->nhom);$i++){
            $data_nhom['don_id']=$request->don_id;
            $data_nhom['nhom_id']=$request->nhom[$i];
            $data_nhom['chiTiet']=$request->chiTietBH[$i];
            DB::table('nhomLienKet')->insertGetId($data_nhom);
        }
       

        
    if($request->NguoiNop>0){
        $data['congTy_id']=$request->NguoiNop;
    }
    else{
        $data_congTy['congTy_ten']=$request->tenCongTy;
        $data_congTy['congTy_diaChi']=$request->diaChi;
        $data_congTy['huyen_id']=$request->huyen;
        $data['congTy_id']=DB::table('congty')->insertGetId($data_congTy);
    }
    DB::table('don')->insert($data);
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return to_route('admin.new_category')->with('success', 'Thêm đơn mới thành công');
       

    }

    public function save_don_KD(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
    if($request->NguoiNop>0){
        $request->validate([
            
            'soCongBoDon'=> 'required',
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'required|image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'tenSP'=> 'required',
            'tacGia'=> 'required',
            
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "soCongBoDon.required"=>"Trường này không được bỏ trống",
            "tenSP.required"=>"Trường này không được bỏ trống",
            "tacGia.required"=>"Trường này không được bỏ trống",
           
        ]);
    }else{
        $request->validate([
            
            'soCongBoDon'=> 'required',
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'required|image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'tenSP'=> 'required',
            'tacGia'=> 'required',
            
            'tenCongTy'=> 'required',
            'diaChi'=> 'required',
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "soCongBoDon.required"=>"Trường này không được bỏ trống",
            "tenSP.required"=>"Trường này không được bỏ trống",
            "tacGia.required"=>"Trường này không được bỏ trống",
           
            "tenCongTy.required"=>"Trường này không được bỏ trống",
            "diaChi.required"=>"Trường này không được bỏ trống",
        ]);
    }
    
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        $data['don_soDon'] = $request->soCongBoDon;
        $data['don_id'] = $request->don_id;
        $data['ngayNop'] = $request->NgayNopDon;
        $data['ngayCongBo'] = $request->NgayCongBo;
        $data['don_tenSP'] = $request->tenSP;
        $data['don_tenTG'] = $request->tacGia;
        $data['trangThai']=0;

        $data['loai_id']=4;

        $year=Carbon::create($request->NgayCongBo)->year;
        $data['don_nam']=$year;


        $get_image = $request->file('image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload',$new_image);
            $data['image'] = $new_image;
            
        }
        
       

        
    if($request->NguoiNop>0){
        $data['congTy_id']=$request->NguoiNop;
    }
    else{
        $data_congTy['congTy_ten']=$request->tenCongTy;
        $data_congTy['congTy_diaChi']=$request->diaChi;
        $data_congTy['huyen_id']=$request->huyen;
        $data['congTy_id']=DB::table('congty')->insertGetId($data_congTy);
    }
    DB::table('don')->insert($data);
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return to_route('admin.new_don_KD')->with('success', 'Thêm đơn mới thành công');
       

    }

    public function save_don_GPHI(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
    if($request->NguoiNop>0){
        $request->validate([
            
            'soCongBoDon'=> 'required',
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'image',
            'tomTat'=> 'required',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'tenSP'=> 'required',
            'tacGia'=> 'required',
            
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "tomTat.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "soCongBoDon.required"=>"Trường này không được bỏ trống",
            "tenSP.required"=>"Trường này không được bỏ trống",
            "tacGia.required"=>"Trường này không được bỏ trống",
           
        ]);
    }else{
        $request->validate([
            
            'soCongBoDon'=> 'required',
            'don_id'=> 'required|unique:don,don_id',
            'image'=> 'image',
            'tomTat'=> 'required',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'tenSP'=> 'required',
            'tacGia'=> 'required',
            
            'tenCongTy'=> 'required',
            'diaChi'=> 'required',
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "tomTat.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "soCongBoDon.required"=>"Trường này không được bỏ trống",
            "tenSP.required"=>"Trường này không được bỏ trống",
            "tacGia.required"=>"Trường này không được bỏ trống",
           
            "tenCongTy.required"=>"Trường này không được bỏ trống",
            "diaChi.required"=>"Trường này không được bỏ trống",
        ]);
    }
    
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        $data['don_soDon'] = $request->soCongBoDon;
        $data['don_id'] = $request->don_id;
        $data['image'] = $request->image;
        $data['ngayNop'] = $request->NgayNopDon;
        $data['ngayCongBo'] = $request->NgayCongBo;
        $data['don_tenSP'] = $request->tenSP;
        $data['don_tenTG'] = $request->tacGia;
        $data['don_tomTat'] = $request->tomTat;

        $data['trangThai']=0;

        $data['loai_id']=5;

        $year=Carbon::create($request->NgayCongBo)->year;
        $data['don_nam']=$year;


        $get_image = $request->file('image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload',$new_image);
            $data['image'] = $new_image;
            
        }
        
       

        
    if($request->NguoiNop>0){
        $data['congTy_id']=$request->NguoiNop;
    }
    else{
        $data_congTy['congTy_ten']=$request->tenCongTy;
        $data_congTy['congTy_diaChi']=$request->diaChi;
        $data_congTy['huyen_id']=$request->huyen;
        $data['congTy_id']=DB::table('congty')->insertGetId($data_congTy);
    }
    DB::table('don')->insert($data);
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return to_route('admin.new_don_KD')->with('success', 'Thêm đơn mới thành công');
       

    }

    public function don_detail($don_id){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $nhom=DB::table('nhom')->get();
        $don_detail=DB::table('don')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id',$don_id)->get();
        $nhom_detail=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        
        return view('admin.don_detail')->with('nhom_detail',$nhom_detail)
                                                ->with('don_detail',$don_detail)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }

    public function unactive_category_product($category_id){
        
       DB::table('category')->where('category_id',$category_id)
                            ->update(['category_status'=> 0]);

        // $alert='Cập nhật thành công!';
        
        return to_route('admin.all_category');
    }
    public function active_category_product($category_id){
        
        DB::table('category')->where('category_id',$category_id)
                             ->update(['category_status'=> 1]);
         
                    
         return to_route('admin.all_category');
     }

     public function edit_category_product($don_id){
        
        $edit_don = DB::table('don')->where('don_id',$don_id)->join('congty','don.congTy_id','congty.congTy_id')->get();
        $data_nhom=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $data_nhom_checked=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $nhom=DB::table('nhom')->get();
        $congty=DB::table('congty')->get();
        $huyen =DB::table('huyen')->get();
        return view('admin.edit_category_product')->with('edit_don', $edit_don)
                                                    ->with('data_nhom', $data_nhom)
                                                    ->with('nhom', $nhom)
                                                    ->with('congty', $congty)
                                                    ->with('huyen', $huyen)
                                                    ->with('data_nhom_checked', $data_nhom_checked);
     }

     public function edit_don_KD($don_id){
        
        $edit_don = DB::table('don')->where('don_id',$don_id)->join('congty','don.congTy_id','congty.congTy_id')->get();
        $data_nhom=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $data_nhom_checked=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $nhom=DB::table('nhom')->get();
        $congty=DB::table('congty')->get();
        $huyen =DB::table('huyen')->get();
        return view('admin.edit_don_kd')->with('edit_don', $edit_don)
                                                    ->with('data_nhom', $data_nhom)
                                                    ->with('nhom', $nhom)
                                                    ->with('congty', $congty)
                                                    ->with('huyen', $huyen)
                                                    ->with('data_nhom_checked', $data_nhom_checked);
     }

     public function edit_don_GPHI($don_id){
        
        $edit_don = DB::table('don')->where('don_id',$don_id)->join('congty','don.congTy_id','congty.congTy_id')->get();
        $data_nhom=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $data_nhom_checked=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $nhom=DB::table('nhom')->get();
        $congty=DB::table('congty')->get();
        $huyen =DB::table('huyen')->get();
        return view('admin.edit_don_gphi')->with('edit_don', $edit_don)
                                                    ->with('data_nhom', $data_nhom)
                                                    ->with('nhom', $nhom)
                                                    ->with('congty', $congty)
                                                    ->with('huyen', $huyen)
                                                    ->with('data_nhom_checked', $data_nhom_checked);
     }

     public function update_don_NH($don_id ,$congTy_id,$image , request $request){
        
          // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
    if($request->NguoiNop>0){
        $request->validate([
            
            
            'image'=> 'image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'nhom'=> 'required',
            
            
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "nhom.required"=>"Trường này không được bỏ trống",
           
           
        ]);
    }else{
        $request->validate([
            
           
            'image'=> 'image',
            'NgayNopDon'=> 'required',
            'NgayCongBo'=> 'required',
            'nhom'=> 'required',
            
            'tenCongTy'=> 'required',
            'diaChi'=> 'required',
        ],
        [
            "don_id.required"=>"Trường này không được bỏ trống",
            "don_id.unique"=>"Mã đơn này đã tồn tại",
            "image.required"=>"Trường này không được bỏ trống",
            "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
            "NgayNopDon.required"=>"Trường này không được bỏ trống",
            "NgayCongBo.required"=>"Trường này không được bỏ trống",
            "nhom.required"=>"Trường này không được bỏ trống",
           
            "tenCongTy.required"=>"Trường này không được bỏ trống",
            "diaChi.required"=>"Trường này không được bỏ trống",
        ]);
    }
    
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        
        $data['image'] = $request->image;
        $data['ngayNop'] = $request->NgayNopDon;
        $data['ngayCongBo'] = $request->NgayCongBo;
        $data['trangThai']=0;

        $data['loai_id']=$request->loai;

        $year=Carbon::create($request->NgayCongBo)->year;
        $data['don_nam']=$year;


        $get_image = $request->file('image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload',$new_image);
            $data['image'] = $new_image;
            
        }else $data['image'] = $image;
        DB::table('nhomLienKet')->where('don_id',$don_id)->delete();
        for($i=0;$i<count($request->nhom);$i++){
            $data_nhom['don_id']=$request->don_id;
            $data_nhom['nhom_id']=$request->nhom[$i];
            $data_nhom['chiTiet']=$request->chiTietBH[$i];
            DB::table('nhomLienKet')->insertGetId($data_nhom);
        }
       

        
    if($request->NguoiNop>0){
        $data['congTy_id']=$request->NguoiNop;
    }
    else{
        $data_congTy['congTy_ten']=$request->tenCongTy;
        $data_congTy['congTy_diaChi']=$request->diaChi;
        $data_congTy['huyen_id']=$request->huyen;
        DB::table('congty')->where('congTy_id',$congTy_id)->update($data_congTy);
    }
        DB::table('don')->where('don_id',$don_id)->update($data);
       
       
       return to_route('admin.don_detail',['don_id' =>$don_id ])->with('success', 'cập nhật thông tin đơn thành công');
     }

     public function update_don_KD($don_id ,$congTy_id,$image , request $request){
        if($request->NguoiNop>0){
            $request->validate([
                
                'soCongBoDon'=> 'required',
                
                'image'=> 'image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'tenSP'=> 'required',
                'tacGia'=> 'required',
                
            ],
            [
                "don_id.required"=>"Trường này không được bỏ trống",
                "don_id.unique"=>"Mã đơn này đã tồn tại",
                "image.required"=>"Trường này không được bỏ trống",
                "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
                "NgayNopDon.required"=>"Trường này không được bỏ trống",
                "NgayCongBo.required"=>"Trường này không được bỏ trống",
                "soCongBoDon.required"=>"Trường này không được bỏ trống",
                "tenSP.required"=>"Trường này không được bỏ trống",
                "tacGia.required"=>"Trường này không được bỏ trống",
               
            ]);
        }else{
            $request->validate([
                
                'soCongBoDon'=> 'required',
                
                'image'=> 'image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'tenSP'=> 'required',
                'tacGia'=> 'required',
                
                'tenCongTy'=> 'required',
                'diaChi'=> 'required',
            ],
            [
                "don_id.required"=>"Trường này không được bỏ trống",
                "don_id.unique"=>"Mã đơn này đã tồn tại",
                "image.required"=>"Trường này không được bỏ trống",
                "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
                "NgayNopDon.required"=>"Trường này không được bỏ trống",
                "NgayCongBo.required"=>"Trường này không được bỏ trống",
                "soCongBoDon.required"=>"Trường này không được bỏ trống",
                "tenSP.required"=>"Trường này không được bỏ trống",
                "tacGia.required"=>"Trường này không được bỏ trống",
               
                "tenCongTy.required"=>"Trường này không được bỏ trống",
                "diaChi.required"=>"Trường này không được bỏ trống",
            ]);
        }
        
            $data = array();
            // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
            $data['don_soDon'] = $request->soCongBoDon;
            
            $data['ngayNop'] = $request->NgayNopDon;
            $data['ngayCongBo'] = $request->NgayCongBo;
            $data['don_tenSP'] = $request->tenSP;
            $data['don_tenTG'] = $request->tacGia;
            $data['trangThai']=0;
    
            $data['loai_id']=4;
    
            $year=Carbon::create($request->NgayCongBo)->year;
            $data['don_nam']=$year;
    
    
            $get_image = $request->file('image');
            // thêm ảnh vào public/upload
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('upload',$new_image);
                $data['image'] = $new_image;
                
            }else $data['image'] = $image;
            
           
    
            
        if($request->NguoiNop>0){
            $data['congTy_id']=$request->NguoiNop;
        }
        else{
            $data_congTy['congTy_ten']=$request->tenCongTy;
            $data_congTy['congTy_diaChi']=$request->diaChi;
            $data_congTy['huyen_id']=$request->huyen;
            DB::table('congty')->where('congTy_id',$congTy_id)->update($data_congTy);
        }
        DB::table('don')->where('don_id',$don_id)->update($data);
       
       
       return to_route('admin.don_detail',['don_id' =>$don_id ])->with('success', 'cập nhật thông tin đơn thành công');
      
      }


      public function update_don_GPHI($don_id ,$congTy_id , request $request){
        if($request->NguoiNop>0){
            $request->validate([
                
                'soCongBoDon'=> 'required',
                'tomTat'=> 'required',
                'image'=> 'image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'tenSP'=> 'required',
                'tacGia'=> 'required',
                
            ],
            [
                "don_id.required"=>"Trường này không được bỏ trống",
                "don_id.unique"=>"Mã đơn này đã tồn tại",
                "image.required"=>"Trường này không được bỏ trống",
                "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
                "NgayNopDon.required"=>"Trường này không được bỏ trống",
                "NgayCongBo.required"=>"Trường này không được bỏ trống",
                "soCongBoDon.required"=>"Trường này không được bỏ trống",
                "tenSP.required"=>"Trường này không được bỏ trống",
                "tacGia.required"=>"Trường này không được bỏ trống",
               
            ]);
        }else{
            $request->validate([
                
                'soCongBoDon'=> 'required',
                
                'image'=> 'image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'tenSP'=> 'required',
                'tacGia'=> 'required',
                'tomTat'=> 'required',

                
                'tenCongTy'=> 'required',
                'diaChi'=> 'required',
            ],
            [
                "don_id.required"=>"Trường này không được bỏ trống",
                "don_id.unique"=>"Mã đơn này đã tồn tại",
                "image.required"=>"Trường này không được bỏ trống",
                "image.image"=>"Trường này chỉ chấp nhận hình ảnh",
                "NgayNopDon.required"=>"Trường này không được bỏ trống",
                "NgayCongBo.required"=>"Trường này không được bỏ trống",
                "soCongBoDon.required"=>"Trường này không được bỏ trống",
                "tenSP.required"=>"Trường này không được bỏ trống",
                "tacGia.required"=>"Trường này không được bỏ trống",
               
                "tenCongTy.required"=>"Trường này không được bỏ trống",
                "diaChi.required"=>"Trường này không được bỏ trống",
            ]);
        }
        
            $data = array();
            // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
            $data['don_soDon'] = $request->soCongBoDon;
            
            $data['ngayNop'] = $request->NgayNopDon;
            $data['ngayCongBo'] = $request->NgayCongBo;
            $data['don_tenSP'] = $request->tenSP;
            $data['don_tenTG'] = $request->tacGia;
            $data['don_tomTat'] = $request->tomTat;
            $data['trangThai']=0;
    
    
            $year=Carbon::create($request->NgayCongBo)->year;
            $data['don_nam']=$year;

    
            $get_image = $request->file('image');
            // thêm ảnh vào public/upload
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('upload',$new_image);
                $data['image'] = $new_image;
                
            }
            
           
    
            
        if($request->NguoiNop>0){
            $data['congTy_id']=$request->NguoiNop;
        }
        else{
            $data_congTy['congTy_ten']=$request->tenCongTy;
            $data_congTy['congTy_diaChi']=$request->diaChi;
            $data_congTy['huyen_id']=$request->huyen;
            DB::table('congty')->where('congTy_id',$congTy_id)->update($data_congTy);
        }
        DB::table('don')->where('don_id',$don_id)->update($data);
       
       
       return to_route('admin.don_detail',['don_id' =>$don_id ])->with('success', 'cập nhật thông tin đơn thành công');
      
      }


     public function delete_category_product($don_id,$congTy_id){
        
        $don = DB::table('don')->join('bang','bang.don_id','don.don_id')->where('don.don_id',$don_id)->first();
        if($don != null){
            return to_route('admin.all_category')->with('error',"Không thể xóa đơn này này vì vẫn còn liên kết với bằng khác.");
          
        }
        else{
            
            DB::table('don')->where('don_id',$don_id)->delete();
            $congTy= DB::table('don')->join('congty','congty.congTy_id','don.congTy_id')->where('congty.congTy_id',$congTy_id)->first();
            if($congTy==NULL){
                DB::table('congty')->where('congTy_id',$congTy_id)->delete();
            }
            return to_route('admin.all_category')->with('success', 'Xóa đơn thành công');
        }
      
      }

      

    
   
   



    
}