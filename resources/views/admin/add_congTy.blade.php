@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Đơn
                        </header>
                        
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('add_congTy')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-3 form-group">    
                                            <span class="text-danger">* </span><label for="">Mã Đơn</label>
                                            <input type="text" name="don_id" class="form-control text-center" placeholder="Nhập mã Đơn" value="{{ $request->don_id }}">
                                            @error('don_id')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
        
                                            
                                        </div>
                                        <div class="col-sm-9 form-group">
                                        <span class="text-danger">* </span> <label for="">Logo</label>
                                        <input type="file" name="image" class="form-control text-center" value="{{ $image }}"  >
                                        @error('image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                    </div>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="">Nhóm</label>
                                        <input  style="resize:none;" rows="3" name="nhom" class="form-control text-center" 
                                         placeholder="Nhập nhóm sản phẩm" vlaue="{{ $request->nhom }}">
                                    </div>
                                <div class="row">
                                    <div class="col-sm-3 form-group">    
                                        <span class="text-danger">* </span><label for="">Ngày nộp Đơn</label>
                                        <input type="date" name="NgayNopDon" class="form-control text-center"  value="{{ $request->NgayNopDon }}">
                                        @error('NgayNopDon')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    <div class=" col-sm-5 form-group">
                                    <span class="text-danger">* </span><label for="">Ngày công bố Đơn</label>
                                        <input type="date" name="NgayCongBo" class="form-control text-center" value="{{ $request->NgayCongBo }}">
                                        @error('NgayCongBo')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span> <label for="">Phân Loại quốc tế</label>
                                            <input type="text" name="PhanLoai" class="form-control text-center" value="{{ $request->PhanLoai }}" placeholder="Nhập phân loại quốc tế">
                                            @error('PhanLoai')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 form-group">    
                                        <span class="text-danger">* </span><label for="">Màu sắc bảo hộ</label>
                                        <input type="text" name="MauSac" class="form-control text-center" placeholder="Nhập màu sắc bảo hộ" value="{{ $request->MauSac }}">
                                        @error('MauSac')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    <div class=" col-sm-5 form-group">
                                    <span class="text-danger">* </span><label for="">Đơn vị nộp đơn nộp đơn</label>
                                    <select name="NguoiNop" id="lang-select" value="{{ $request->NguoiNop }}" class="form-control text-center">
                                        <option value="0">--Thêm mới--</option>
                                       
                                        @error('NguoiNop')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                    </select>
                                        
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span> <label for="">Loại</label>
                                        <select name="loai" id="lang-select" value="{{ $request->loai }}" class="form-control text-center text-center">
                                        <option value="0">--Không có--</option>
                                        @foreach($loai as $key=>$loai)
                                        <option value="{{$loai->loai_id}}">{{$loai->loai_ten}}</option>
                                        
                                        @endforeach
                                        @error('loai')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        </select>
                                           
                                        </div>
                                </div>
                                <h2 class="panel-heading">
                                    Thêm Thông tin đơn vị nộp đơn
                                </h2>
                                <div class="form-group">    
                                        <span class="text-danger">* </span><label for="">Tên đơn vị nộp đơn</label>
                                        <input type="text" name="tenCongTy" class="form-control text-center" placeholder="Nhập tên đơn vị nộp đơn" value="{{ old('tenCongTy') }}">
                                        @error('tenCongTy')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                <div class="row">
                                    
                                    <div class=" col-sm-5 form-group">
                                    <span class="text-danger">* </span><label for="">Địa chỉ</label>
                                    <input type="text" name="diaChi" class="form-control text-center" placeholder="Nhập địa chỉ" value="{{ old('diaChi') }}">
                                        @error('diaChi')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </select>
                                        
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span> <label for="">Huyện</label>
                                        <select name="huyen" id="lang-select" value="{{ old('huyen') }}" class="form-control text-center text-center">
                                        @foreach($huyen as $key => $huyen)
                                        <option value="{{$huyen->huyen_id}}">{{$huyen->huyen_ten}}</option>
                                        @endforeach
                                        @error('huyen')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        </select>
                                           
                                        </div>
                                        
                                </div>
                                <div class="form-group">    
                                        <span class="text-danger">* </span><label for="">Tên công ty sở hữu</label>
                                        <input type="text" name="soHuu" class="form-control text-center" placeholder="Nhập tên đơn vị nộp đơn" value="{{ old('soHuu') }}">
                                        @error('soHuu')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                               
                            
                                <button type="submit" class="btn btn-info" name="add_category_product">Thêm</button>
                                <a  class="btn btn-warning" name="quay lai" type="button" href="{{ route('admin.all_category') }}">Hủy</a>
                           
                            </form>
                           
                                </div>
                            </div>

                        </div>
                    </section>
                  
            </div>
          

@endsection