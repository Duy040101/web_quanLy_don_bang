@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
    
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa Bằng
                        </header>
                        
                            <div class="panel-body">
                          @foreach($edit_bang as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.update_brand',['bang_id' =>$edit_value->bang_id , 'don_id'=>$edit_value->don_id])}}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 form-group">    
                                                <span class="text-danger">* </span><label for="">Mã Bằng: {{$edit_value->bang_id}}</label>
                                                
                        
                                            @error('bang_id')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror    
                                            </div>
                                            <div class="col-sm-4     form-group">
                                                <span class="text-danger">* </span> <label for="">Mã Đơn</label>
                                                <select class="basic-select col-sm-12 form-group" id="states" name="don_id"  value="{{ $edit_value->don_id }}"  >

                                                    
                                                    @foreach($don as $key=>$don)
                                                        

                                                        @if($don->don_id == $edit_value->don_id)
                                                        
                                                        <option selected value="{{$don->don_id}}" >{{$don->don_id}}</option>
                                                        @else
                                                        <option value="{{$don->don_id}}" >{{$don->don_id}}</option>
                                                        @endif

                                                    @endforeach
                                                   
                                                    
                                                </select>
                                                @error('don_id')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                                    @enderror
            
                                                </div>
                                            <div class="col-sm-3 form-group">    
                                                <span class="text-danger">* </span><label for="">Ngày cấp</label>
                                                <input type="date" name="NgayCap" class="form-control text-center"  value="{{ $edit_value->ngayCap }}">
                                                @error('NgayCap')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </div>
                                            </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3 form-group">    
                                                <span class="text-danger">* </span><label for="">Ngày hiệu lực</label>
                                                <input type="date" name="NgayHieuLuc" class="form-control text-center"  value="{{ $edit_value->ngayHieuLuc }}">
                                                @error('NgayHieuLuc')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </div>
                                            
                                            <div class="col-sm-4 form-group">    
                                                <span class="text-danger">* </span><label for="">Ngày kết thúc</label>
                                                <input type="date" name="NgayKetThuc" class="form-control text-center"  value="{{ $edit_value->ngayKetThuc }}">
                                                @error('NgayKetThuc')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </div>
                                            
                                        </div>
                                
                                
                                </div>
                                
                            
                                <button type="submit" class="btn btn-info" name="add_brand_product">Cập nhật</button>
                            </form>
                           
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </section>
                   
      
            </div>
          

@endsection