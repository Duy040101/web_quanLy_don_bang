@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Đơn (SC/GPHI)
                        </header>
                        
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('save_don_GPHI')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                    <div class="col-sm-4 form-group">    
                                            <span class="text-danger">* </span><label for="">Số công bố đơn(11)</label>
                                            <input type="text" name="soCongBoDon" class="form-control text-center" value="{{ old('soCongBoDon') }}" placeholder="Nhập phân loại quốc tế">
                                            @error('soCongBoDon')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
        
                                            
                                        </div>
                                        <div class="col-sm-4     form-group">
                                        <span class="text-danger">* </span> <label for="">Mã Đơn(21)</label>
                                            <input type="text" name="don_id" class="form-control text-center" placeholder="Nhập mã Đơn" value="{{ old('don_id') }}">
                                            @error('don_id')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                            

                                        
                                        </div>
                                    <div class="col-sm-4 form-group">
                                    <span class="text-danger">* </span><label for="">Tên sáng chế (54)</label>
                                        <input type="text" name="tenSP" class="form-control text-center" placeholder="Nhập màu sắc bảo hộ" value="{{ old('tenSP') }}">
                                        @error('tenSP')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror

                                        
                                    </div>
                                    </div>

                                    

                                    
                                <div class="row">
                                    
                                <div class=" col-sm-4 form-group">
                                    <span class="text-danger">* </span><label for="">Ngày nộp Đơn(22)</label>
                                        <input type="date" name="NgayNopDon" class="form-control text-center"  value="{{ old('NgayNopDon') }}">
                                        @error('NgayNopDon')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror


                                    
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span><label for="">Ngày công bố Đơn(43)</label>
                                        <input type="date" name="NgayCongBo" class="form-control text-center" value="{{ old('NgayCongBo') }}">
                                        @error('NgayCongBo')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror

                                       
                                        </div>
                                        <div class="col-sm-4 form-group"> 
                                        <span class="text-danger">* </span> <label for="">Tên tác giả (72)</label>
                                        <input type="text" class="form-control text-center" name="tacGia" value="{{ old('tacGia') }}">
                                        @error('tacGia')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror   
                                        
                                        
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <span class="text-danger">* </span> <label for="">Tóm tắt sáng chế(57)</label>
                                        <textarea type="password" style="resize:none;" rows="6" name="tomTat" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" value="">{{ old('tomTat') }}</textarea>
                                        @error('tomTat')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-4 form-group">
                                    <label for="">Hình ảnh (55)</label>
                                        <input type="file" name="image" class="form-control"  >
                                        @error('image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        
                                        </div>
                                    <div class=" col-sm-8 form-group" >
                                    <span class="text-danger">* </span><label for="">Đơn vị nộp đơn nộp đơn</label>
                                     
                                    <select class="form-control text-center" id="states" name="NguoiNop"  value="{{ old('NguoiNop') }}"  >

                                        <option value="-1" >--Thêm mới--</option>
                                        @foreach($congty as $key=>$congty)
                                        <option value="{{$congty->congTy_id}}" >{{$congty->congTy_ten}}</option>
                                        
                                        @endforeach
                                        @error('NguoiNop')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                    </select>

                                    
                                        
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