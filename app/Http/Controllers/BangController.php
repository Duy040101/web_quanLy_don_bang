<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class BangController extends Controller
{
    public function add_brand_product(){
        $don=DB::table('don')->get();
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->limit(3)->get();
        $nhom=DB::table('nhom')->get();
        
        return view('admin.add_brand_product')->with('don',$don)
                                                ->with('loai',$loai)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }

    public function all_bang(Request $request){
        $search = $request->search ?? '';
        $data=$request;
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        /* $all_brand_product = DB::table('brand')->where('brand_name','like',"%$search%")->paginate(5); */ 
        $all_bang = DB:: table('bang')->join('don','bang.don_id','don.don_id')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->orwhere('bang.bang_id','like',"%$search%")
                            ->get();
        if($request->huyen!=0){
            $all_bang=$all_bang->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $all_bang=$all_bang->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $all_bang=$all_bang->where('nam',$request->nam);
        }
                
        
        return view('admin.all_bang')
                                    ->with('data', $data)
                                    ->with('huyen',$huyen)
                                    ->with('loai',$loai)
                                    ->with('all_bang', $all_bang);
    }

    public function bang_detail($bang_id,$don_id){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $nhom=DB::table('nhom')->get();
        $bang_detail=DB::table('bang')->join('don','don.don_id','bang.don_id')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('bang.bang_id',$bang_id)->get();
        $nhom_detail=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();

        return view('admin.bang_detail')->with('nhom_detail',$nhom_detail)
                                                ->with('bang_detail',$bang_detail)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }

    public function save_brand_product(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
        if($request->don_id_old!="-1"){
        $request->validate([
            
            'bang_id'=> 'required|unique:bang,bang_id',
            'don_id'=> 'unique:bang,don_id',
            'NgayCap'=> 'required',
            'NgayHieuLuc'=> 'required',
            'NgayKetThuc'=> 'required',
        ],
        [
            "bang_id.required"=>"Trường này không được bỏ trống",
            "bang_id.unique"=>"Mã bằng này đã tồn tại",
            "don_id.unique"=>"Đơn này đã liên kết với bằng khác",
            "NgayCap.required"=>"Trường này không được bỏ trống",
            "NgayHieuLuc.required"=>"Trường này không được bỏ trống",
            "NgayKetThuc.required"=>"Trường này không được bỏ trống",
        ]);
    }else{
        if($request->NguoiNop>0){
            $request->validate([

                'bang_id'=> 'required|unique:bang,bang_id',
                'don_id'=> 'unique:bang,don_id',
                'NgayCap'=> 'required',
                'NgayHieuLuc'=> 'required',
                'NgayKetThuc'=> 'required',
                    
                'don_id'=> 'required|unique:don,don_id',
                'image'=> 'required|image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'nhom'=> 'required',
                
                
            ],
            [
                "bang_id.required"=>"Trường này không được bỏ trống",
                "bang_id.unique"=>"Mã bằng này đã tồn tại",
                "don_id.unique"=>"Đơn này đã liên kết với bằng khác",
                "NgayCap.required"=>"Trường này không được bỏ trống",
                "NgayHieuLuc.required"=>"Trường này không được bỏ trống",
                "NgayKetThuc.required"=>"Trường này không được bỏ trống",

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

                'bang_id'=> 'required|unique:bang,bang_id',
                'don_id'=> 'unique:bang,don_id',
                'NgayCap'=> 'required',
                'NgayHieuLuc'=> 'required',
                'NgayKetThuc'=> 'required',
                    
                'don_id'=> 'required|unique:don,don_id',
                'image'=> 'required|image',
                'NgayNopDon'=> 'required',
                'NgayCongBo'=> 'required',
                'nhom'=> 'required',
                
                'tenCongTy'=> 'required',
                'diaChi'=> 'required',
            ],
            [
                "bang_id.required"=>"Trường này không được bỏ trống",
                "bang_id.unique"=>"Mã bằng này đã tồn tại",
                "don_id.unique"=>"Đơn này đã liên kết với bằng khác",
                "NgayCap.required"=>"Trường này không được bỏ trống",
                "NgayHieuLuc.required"=>"Trường này không được bỏ trống",
                "NgayKetThuc.required"=>"Trường này không được bỏ trống",

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
    }
        $data_bang = array();
        // 'brand_name' là của cột trong bảng brand tên phải giống với cột trong csdl ko đc khác
        $data_bang['bang_id'] = $request->bang_id;
        $data_bang['ngayCap'] = $request->NgayCap;
        $data_bang['ngayHieuLuc'] = $request->NgayHieuLuc;
        $data_bang['ngayKetThuc'] = $request->NgayKetThuc;
        $data_bang['bang_nam'] = Carbon::create($request->NgayHieuLuc)->year;

        if($request->don_id_old!="-1"){
            $data_bang['don_id']=$request->don_id_old;
            DB::table('don')->where('don_id',$request->don_id_old)->update(['trangThai'=> 1]);
        }else{
            $data = array();
            // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
            $data['don_id'] = $request->don_id;
            $data['image'] = $request->image;
            $data['ngayNop'] = $request->NgayNopDon;
            $data['ngayCongBo'] = $request->NgayCongBo;
            $data['trangThai']=1;

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
        $data_bang['don_id']=$request->don_id;
        }


        DB::table('bang')->insert($data_bang);
       
        // Alert::success('Success Title', 'Success Message');
        /* A way to pass a message to the next request. */
    /*  */
     
        
      
        return to_route('admin.add_brand')->with('success', 'Thêm bằng mới thành công');
       

    }

     public function edit_brand_product($bang_id,$don_id){

        $don = DB::table('don')->join('congty','don.congTy_id','congty.congTy_id')->get();
        $data_nhom=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $data_nhom_checked=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        $nhom=DB::table('nhom')->get();
        $congty=DB::table('congty')->get();
        $huyen =DB::table('huyen')->get();
        
        $edit_bang = DB::table('bang')->where('bang_id',$bang_id)->join('don','don.don_id','bang.don_id')->get(); 
        return view('admin.edit_brand_product')->with('edit_bang', $edit_bang)
                                                ->with('don', $don)
                                                ->with('data_nhom', $data_nhom)
                                                ->with('nhom', $nhom)
                                                ->with('congty', $congty)
                                                ->with('huyen', $huyen)
                                                ->with('data_nhom_checked', $data_nhom_checked);
     }
     public function update_brand_product($bang_id,$don_id, Request $request){

        if($request->don_id!=$don_id){
            $request->validate([
                
                
                'don_id'=> 'unique:bang,don_id',
                'NgayCap'=> 'required',
                'NgayHieuLuc'=> 'required',
                'NgayKetThuc'=> 'required',
            ],
            [
                "don_id.unique"=>"Đơn này đã liên kết với bằng khác",
                "NgayCap.required"=>"Trường này không được bỏ trống",
                "NgayHieuLuc.required"=>"Trường này không được bỏ trống",
                "NgayKetThuc.required"=>"Trường này không được bỏ trống",
            ]);
        }else{

            $request->validate([
                'NgayCap'=> 'required',
                'NgayHieuLuc'=> 'required',
                'NgayKetThuc'=> 'required',
            ],
            [
                "NgayCap.required"=>"Trường này không được bỏ trống",
                "NgayHieuLuc.required"=>"Trường này không được bỏ trống",
                "NgayKetThuc.required"=>"Trường này không được bỏ trống",
            ]);
        }
        
        $data_bang = array();
        $data_bang['ngayCap'] = $request->NgayCap;
        $data_bang['ngayHieuLuc'] = $request->NgayHieuLuc;
        $data_bang['ngayKetThuc'] = $request->NgayKetThuc;
        $data_bang['bang_nam'] = Carbon::create($request->NgayHieuLuc)->year;
        $data_bang['don_id']=$request->don_id;

       DB::table('bang')->where('bang_id',$bang_id)->update($data_bang);
       DB::table('don')->where('don_id',$don_id)->update(['trangThai'=> 0]);
       DB::table('don')->where('don_id',$request->don_id)->update(['trangThai'=> 1]);

      
       return to_route('admin.all_brand')->with('success', 'Cập nhật thông tin bằng thành công');
     }
     public function delete_brand_product($bang_id,$don_id){
        
        
            DB::table('bang')->where('bang_id',$bang_id)->delete();
            DB::table('don')->where('don_id',$don_id)->update(['trangThai'=> 0]);
           
            return to_route('admin.all_brand')->with('success', 'Xóa bằng thành công hiệu thành công');
        
      
      }

    //   end admin
    
    
}