@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa Đơn
                        </header>
                        
                            <div class="panel-body">
                          @foreach($edit_don as $key => $edit_value)
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.update_category',['don_id' =>$edit_value->don_id ,'congTy_id' =>$edit_value->congTy_id  ,'image'=>$edit_value->image])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-4 form-group">    
                                            <label for="">Mã Đơn: {{$edit_value->don_id}}</label>
                                            
        
                                            
                                        </div>
                                        <div class="col-sm-4     form-group">
                                        
                                        <span class="text-danger">* </span><label for="">Ngày công bố Đơn</label>
                                        <input type="date" name="NgayCongBo" class="form-control text-center" value="{{ $edit_value->ngayCongBo }}">
                                        @error('NgayCongBo')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                        
                                        </div>
                                    <div class="col-sm-4 form-group">    
                                        <span class="text-danger">* </span><label for="">Ngày nộp Đơn</label>
                                        <input type="date" name="NgayNopDon" class="form-control text-center"  value="{{ $edit_value->ngayNop }}">
                                        @error('NgayNopDon')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    </div>

                                    

                                    
                                <div class="row">
                                    
                                    <div class=" col-sm-4 form-group">
                                        <span class="text-danger">* </span><label for="">Nhóm</label>
                                       
                                            <br>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-success btn-sm open_modal" data-toggle="modal"
                                                data-target="#myModal1">
                                                Thêm nhóm
                                            </button>
                                            @error('nhom')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                           
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        
                                       
                                        </div>
                                        <div class="col-sm-4 form-group">
                                        
                                        
                                        </div>
                                    <div class="col-sm-12 form-group">
                                    <p id="kq">
                                        @foreach($data_nhom as $data_nhom)
                                            <label for="">Thông tin bảo hộ nhóm {{$data_nhom->nhom_ten}}:</label>
                                            <input type="text" name="chiTietBH[]" class="form-control" value="{{$data_nhom->chiTiet}}">
                                            <br>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                    <label for="">Hình ảnh</label>
                                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}"  >
                                        @error('image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 form-group">
                                    <label for="" class="form-group">Hình ảnh cũ</label>
                                        <img src="{{asset('upload/'.$edit_value->image)}}" alt=""  style="max-width:90%px">
                                    </div>
                                    <div class=" col-sm-12 form-group" >
                                    <span class="text-danger">* </span><label for="">Đơn vị nộp đơn nộp đơn</label>
                                     
                                    <select class="form-control text-center" id="states" name="NguoiNop"  value="{{ old('NguoiNop') }}"  >

                                        <option value="-1" >--Thông tin hiện tại--</option>
                                        @foreach($congty as $key=>$congty)
                                        @if($congty->congTy_id == $edit_value->congTy_id)
                                                        
                                            
                                            @else
                                                <option value="{{$congty->congTy_id}}" >{{$congty->congTy_ten}}</option>
                                        @endif
                                        
                                        @endforeach
                                        @error('NguoiNop')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                        @enderror
                                        
                                    </select>
                                    <input type="text" style="display:none; " name="congty_id" value="{{$edit_value->congTy_id}}">
                                    
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                    
                                           

                                        
                                    <div class="row">
                
                                    <div class="col-sm">


                                       
                                        
                                    
                                        
                                    </div>

                                    </div>
                                </div>
                                <!-- Ẩn/hiện các trường thêm thông tin công ty -->
                                <script>
                                     document.getElementById("states").onchange= function () {
                                        if (document.getElementById("states").value<0){
                                                        document.getElementById("addCongTy").style.display = 'block';
                                                        document.getElementById("submit").innerHTML="<button type=\"submit\" class=\"btn btn-info\" onclick=\"return confirm(\'Các đơn có cùng đơn vị nộp đơn này cũng sẽ thay đổi thông tin. Bạn có chắc muốn thực hiện không không?\')\">Cập nhật</button>";
                                                    
                                                        
                                                    }else{
                                                        document.getElementById("addCongTy").style.display = 'none';
                                                        document.getElementById("submit").innerHTML="<button type=\"submit\" class=\"btn btn-info\" >Cập nhật</button>"
                                                    }
                                                };
                                       
                                </script>
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
                                                                <?php
                                                                    $ischecked=false;
                                                                    foreach($data_nhom_checked as $key => $checked){
                                                                       
                                                                        if($checked->nhom_id==$nhom->nhom_id) $ischecked=true;
                                                                    
                                                                    }
                                                                    ?>
                                                                
                                                                <div id="nhom_{{$nhom->nhom_id}}" class="col-sm-4 form-group" >
                                                                    <label for="nhom[]"  >{{$nhom->nhom_ten}}</label>
                                                                    @if($ischecked)
                                                        
                                                                        <input  type="checkbox" name="nhom[]" value="{{$nhom->nhom_id}}" checked /> </div>
                                                                        @else
                                                                        <input  type="checkbox" name="nhom[]" value="{{$nhom->nhom_id}}"/> </div>
                                                                    @endif
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
                                <!-- Thông tin công ty -->
                                <div id="addCongTy">
                                        <h2 class="panel-heading">
                                            Chỉnh sửa thông tin đơn vị nộp đơn
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
                                            <input type="text" name="diaChi" class="form-control text-center" placeholder="Nhập địa chỉ" value="{{ $edit_value->congTy_diaChi    }}">
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
                                        <div class="form-group">    
                                                <span class="text-danger">* </span><label for="">Tên công ty sở hữu</label>
                                               
                                            </div>
                                </div> 
                                
                                <div id="submit">
                                
                                <button type="submit" class="btn btn-info" onclick="return confirm('Các Đơn có cùng đơn vị nộp đơn này cũng sẽ thay đổi thông tin. Bạn có chắc muốn thực hiện không không?')">Cập nhật</button>  
                                </div>
                            </form>
                                    
                            
                                
                           
                               
                               
                                            </div>
                                @endforeach
                            </div>

                        </div>
                    </section>
                   
      
            </div>
          

@endsection