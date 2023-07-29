@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Đơn (NH/NHTT/NHCN)
                        </header>
                        
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('save_don_NH')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-4 form-group">    
                                            <span class="text-danger">* </span><label for="">Mã Đơn (210)</label>
                                            <input type="text" name="don_id" class="form-control text-center" placeholder="Nhập mã Đơn" value="{{ old('don_id') }}">
                                            @error('don_id')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
        
                                            
                                        </div>
                                        <div class="col-sm-4     form-group">
                                        <span class="text-danger">* </span> <label for="">Hình ảnh</label>
                                        <input type="file" name="image" class="form-control" value="{{ old('image') }}"  >
                                        @error('image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        </div>
                                    <div class="col-sm-4 form-group">    
                                        <span class="text-danger">* </span><label for="">Ngày nộp Đơn</label>
                                        <input type="date" name="NgayNopDon" class="form-control text-center"  value="{{ old('NgayNopDon') }}">
                                        @error('NgayNopDon')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    </div>

                                    

                                    
                                <div class="row">
                                    
                                    <div class=" col-sm-4 form-group">
                                    <span class="text-danger">* </span><label for="">Ngày công bố Đơn</label>
                                        <input type="date" name="NgayCongBo" class="form-control text-center" value="{{ old('NgayCongBo') }}">
                                        @error('NgayCongBo')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                  
                                    
                                    <div class="col-sm-4 form-group">


                                    <span class="text-danger">* </span><label for="">Loại</label>
                                        <select class="form-control text-center"  name="loai"  value="{{ old('loai') }}"  >
                                            @foreach($loai as $key=>$loai)
                                            <option value="{{$loai->loai_id}}" >{{$loai->loai_ten}}</option>
                                            
                                            @endforeach
                                            
                                            </select>
                                        
                                        
                                           
                                        </div>
                                    
                                    
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span><label for="">Nhóm (511)</label>
                                        
                                        <br>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm open_modal" data-toggle="modal"
                                            data-target="#myModal1">
                                            Thêm nhóm
                                        </button>
                                        <br>
                                        @error('nhom')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                            @enderror
                                        <div class="row">


                                    </div>
                                </div>
                                
                                </div>
                                <div class="row">
                                    <p id="kq" class=" col-sm-12 form-group"></p>
                                </div>
                                <div class="row">
                                <div class=" col-sm-12 form-group" >
                                    <span class="text-danger">* </span><label for="">Đơn vị nộp đơn nộp đơn (731)</label>
                                     
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
                                </div>
                                
                                <div class="">
                                    
                                    <div class="form-group">
                                           
                                        <div class="">
                    
                                        <div class="col-sm">

                                        
                                        <!-- Thêm thông tin bảo hộ cho nhóm -->
                                        <script>
                                            function addNhom(){
                                                var nhom = <?php echo(json_encode($nhom)); ?>; 
                                                
                                                var arr = document.getElementsByName("nhom[]");
                                                var str = "";
                                                for (var i = 0; i < arr.length; i++)if (arr[i].checked) {
                                                    for( var j =0; j< nhom.length; j++)
                                                        if(arr[i].value==nhom[j].nhom_id){
                                                            str= str +"<label> Thông tin bảo hộ " + nhom[j].nhom_ten +": </label>" +" <input type=\"text\" name=\"chiTietBH[]\" class=\"form-control\" ><br/>" }
                                                    
                                                }
                                                document.getElementById("kq").innerHTML=str;
                                            }
                                        
                                        </script>
                                        <!-- Modal chọn các nhóm -->
                                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <a type="submit" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></a>
                                                            <h2 class="modal-title" id="myModalLabel">Thông tin nhóm</h2>
                                                        </div>
                                                        <div class="modal-body">
                                        
                                                            <div class="form-one" style="width:100%">
                                        
                                                                @foreach ($nhom as $nhom)
                                                                
                                                                <div id="nhom_{{$nhom->nhom_id}}" class="col-sm-4 form-group" >
                                                                    <label for="nhom[]"  >{{$nhom->nhom_ten}}</label>
                                                                    <input  type="checkbox" name="nhom[]" value="{{$nhom->nhom_id}}"/> </div> 
                                                                 <!-- Hiển thị thông tin nhóm -->
                                                                 <script>
                                                                    document.getElementById("nhom_"+{{$nhom->nhom_id}}).onmouseover= function () {
                                                                    str ="<br> <b>Chi tiết nhóm {{$nhom->nhom_id}}</b> <br>"+`{{$nhom->nhom_chiTiet}}`;
                                                                    document.getElementById("chiTietNhom").innerHTML=str;     
                                                                        
                                                                    };
                                                                </script>
                                                                @endforeach
                                                                <br>
                                                                <br>
                                                                </div>
                                                            </div>
                                                            <div class="" style="margin:5px;">
                                                                <div id="chiTietNhom"></div>
                                                            </div>
                                                            <div class="modal-footer ">
                                            
                                            
                                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                                    style="margin-top:10px" onclick="addNhom()">Lưu</button>
                                                                <button type="button" class="btn btn-info" data-dismiss="modal"
                                                                    style="margin-top:10px">Đóng</button>
                                                            </div>
                                                            
                                                            
                                                            
                                                        </div>
                            
                                            </div>
                    </div>
                                            
                                        </div>

                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- Ẩn/hiện các trường thêm thông tin công ty -->
                                <script>
                                     document.getElementById("states").onchange= function () {
                                            if (document.getElementById("states").value<0){
                                                document.getElementById("addCongTy").style.display = 'block';
                                               
                                                
                                            }else{
                                                document.getElementById("addCongTy").style.display = 'none';
                                               
                                            }
                                        };
                                </script>
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