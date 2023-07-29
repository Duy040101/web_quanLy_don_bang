@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
            @foreach($edit_don as $edit_value)
                    <section class="panel">
                        <header class="panel-heading">
                            chỉnh sửa Đơn (SC/GPHI): {{$edit_value->don_id}}
                        </header>
                        
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.update_don_GPHI',['don_id' =>$edit_value->don_id ,'congTy_id' =>$edit_value->congTy_id  ])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                    <div class="col-sm-4 form-group">    
                                            <span class="text-danger">* </span><label for="">Số công bố đơn(11)</label>
                                            <input type="text" name="soCongBoDon" class="form-control text-center" value="{{ $edit_value->don_soDon }}">
                                            @error('soCongBoDon')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
        
                                            
                                        </div>
                                        <div class="col-sm-4     form-group">
                                        <span class="text-danger">* </span> <label for="">Mã Đơn(21): {{$edit_value->don_id}}</label>
                                            
                                            

                                        
                                        </div>
                                    <div class="col-sm-4 form-group">
                                    <span class="text-danger">* </span><label for="">Tên sáng chế (54)</label>
                                        <input type="text" name="tenSP" class="form-control text-center" placeholder="Nhập màu sắc bảo hộ" value="{{ $edit_value->don_tenSP }}">
                                        @error('tenSP')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror

                                        
                                    </div>
                                    </div>

                                    

                                    
                                <div class="row">
                                    
                                <div class=" col-sm-4 form-group">
                                    <span class="text-danger">* </span><label for="">Ngày nộp Đơn(22)</label>
                                        <input type="date" name="NgayNopDon" class="form-control text-center"  value="{{ $edit_value->ngayNop }}">
                                        @error('NgayNopDon')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror


                                    
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span><label for="">Ngày công bố Đơn(43)</label>
                                        <input type="date" name="NgayCongBo" class="form-control text-center" value="{{ $edit_value->ngayCongBo }}">
                                        @error('NgayCongBo')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror

                                       
                                        </div>
                                        <div class="col-sm-4 form-group"> 
                                        <span class="text-danger">* </span> <label for="">Tên tác giả (72)</label>
                                        <input type="text" class="form-control text-center" name="tacGia" value="{{ $edit_value->don_tenTG }}">
                                        @error('tacGia')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror   
                                        
                                        
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <span class="text-danger">* </span> <label for="">Tóm tắt sáng chế(57)</label>
                                        <textarea type="password" style="resize:none;" rows="6" name="tomTat" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" value="">{{ $edit_value->don_tomTat }}</textarea>
                                        @error('tomTat')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-4 form-group">
                                    <span class="text-danger">* </span> <label for="">Hình ảnh (55)</label>
                                        <input type="file" name="image" class="form-control"  >
                                        @error('image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        
                                        </div>
                                    <div class=" col-sm-8 form-group" >
                                    <label class=" col-sm-12 form-group" for="">Hình ảnh cũ: </label>
                                        <img class=" col-sm-12 form-group" src="{{asset('upload/'.$edit_value->image)}}" alt=""  style="max-width:90%px">
                                    </select>

                                    
                                        
                                    </div>
                                    <div >
                                    <div class=" col-sm-12 form-group" >
                                    <span class="text-danger">* </span><label for="">Đơn vị nộp đơn nộp đơn</label>
                                     
                                    <select class="form-control text-center" id="states" name="NguoiNop"  value="{{ old('NguoiNop') }}"  >

                                        <option value="-1" >--Thông tin hiện tại--</option>
                                        @foreach($congty as $key=>$congty)
                                        @if($congty->congTy_id != $edit_value->congTy_id)
                                        <option value="{{$congty->congTy_id}}" >{{$congty->congTy_ten}}</option>
                                        @endif
                                        @endforeach
                                        @error('NguoiNop')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                    </select>

                                    
                                        
                                    </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for=""></label>
                                        <div class="row">
                
                                    <div class="col-sm">


                                       
                                        
                                    
                                        
                                    </div>

                                    </div>
                                </div>
                                <!-- Ẩn/hiện các trường thêm thông tin công ty -->
                                <script>
                                     document.getElementById("states").onchange= function () {
                                            if (document.getElementById("states").value==0){
                                                document.getElementById("addCongTy").style.display = 'block';
                                               
                                                
                                            }else{
                                                document.getElementById("addCongTy").style.display = 'none';
                                               
                                            }
                                        };
                                </script>
                                </div>
                                
                                <!-- Thông tin công ty -->
                                <div id="addCongTy">
                                        <h2 class="panel-heading">
                                            Thêm Thông tin đơn vị nộp đơn
                                        </h2>
                                        <div class="form-group">    
                                                <span class="text-danger">* </span><label for="">Tên đơn vị nộp đơn</label>
                                                <input type="text" name="tenCongTy" class="form-control text-center" placeholder="Nhập tên đơn vị nộp đơn" value="{{ $edit_value->congTy_ten }}">
                                                @error('tenCongTy')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                            </div>
                                        <div class="row">
                                            
                                            <div class=" col-sm-5 form-group">
                                            <span class="text-danger">* </span><label for="">Địa chỉ</label>
                                            <input type="text" name="diaChi" class="form-control text-center" placeholder="Nhập địa chỉ" value="{{ $edit_value->congTy_diaChi  }}">
                                                @error('diaChi')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                            </select>
                                                
                                            </div>
                                        
                                            <div class="col-sm-4 form-group">
                                                <span class="text-danger">* </span> <label for="">Huyện</label>
                                                <select name="huyen" id="lang-select" value="{{ old('huyen') }}" class="form-control text-center text-center">
                                                @foreach($huyen as $key => $huyen)
                                                @if($huyen->huyen_id == $edit_value->huyen_id)
                                                                
                                                    <option selected value="{{$huyen->huyen_id}}" >{{$huyen->huyen_ten}}</option>
                                                    @else
                                                        <option value="{{$huyen->huyen_id}}" >{{$huyen->huyen_ten}}</option>
                                                @endif
                                                @endforeach
                                                @error('huyen')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </select>
                                                
                                                </div>
                                                
                                        </div>
                                        
                                    
                            
                                
                           
                               
                               
                                            </div>
                                        
                                <button type="submit" class="btn btn-info" name="add_category_product">Thêm</button>
                                <a  class="btn btn-warning" name="quay lai" type="button" href="{{ route('admin.all_category') }}">Hủy</a>
                           
                                </form>
                           
                                </div>
                            </div>

                        </div>
                    
                    
                    
                    </section>
                @endforeach
            </div>
          

@endsection