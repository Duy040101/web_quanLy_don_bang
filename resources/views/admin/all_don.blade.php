@extends('admin_layout')
@section('admin_content')
<style>
.edit{
  color: #fff!important;

}
</style>

<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
  
    <div class="panel-heading">
      Liệt kê Đơn
    </div>
    
    <div class="row ">
    {{csrf_field()}}
      <form action="">
      <div class="col-sm-12 m-b-xs">
        <div class="col-sm-3">
        <label for="">Huyện</label>
        <select name="huyen" id="lang-select" class="form-control text-center ">
                                                <option value="0">Tất cả huyện</option>
                                                @foreach($huyen as $key => $huyen)
                                                  @if($huyen->huyen_id==$data->huyen)
                                                  <option selected value="{{$huyen->huyen_id}}">{{$huyen->huyen_ten}}</option>
                                                  @else
                                                    <option value="{{$huyen->huyen_id}}">{{$huyen->huyen_ten}}</option>
                                                  @endif
                                                @endforeach
                                                @error('huyen')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </select>
        </div>
        <div class="col-sm-3">
        <label for="">Loại</label>
        <select name="loai" id="lang-select" class="form-control text-center ">
                                                <option value="0">Tất cả</option>
                                                @foreach($loai as $key => $loai)
                                                  @if($loai->loai_id==$data->loai)
                                                  <option selected value="{{$loai->loai_id}}">{{$loai->loai_ten}}</option>
                                                  @else
                                                    <option value="{{$loai->loai_id}}">{{$loai->loai_ten}}</option>
                                                  @endif
                                                @endforeach
                                                @error('huyen')
                                                                <span class="text-danger" style="color: red">{{ $message }} </span>
                                                @enderror
                                                </select>
        </div>
        <div class="col-sm-3">
        <label for="">Năm</label>
        <input type="number" name="nam" class="form-control text-center text-center" value="{{$data->nam}}">
        </div>
        <div class="col-sm-2">
          <br>
        <button class="active btn btn-sm btn-success ">Áp dụng</button>
        </div>
        </form>
        <br>
        <form action=""></form>
        <button type="submit" class="active btn btn-sm btn-success "ui-toggle-class=""><a href="{{ route('admin.print_don_to_excel') }}">
                 Xuất ra excel
              </a></button>
      </div>
      
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
          
            <th>Mã Đơn</th>
            <th>Hình ảnh</th>
            <th>Đơn vị nộp Đơn</th>
            <th >Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($don as $key => $all_don)
          <tr>
           
            <td><a href="">{{$all_don->don_id}}</a></td>
            <td><a href=""><span class="text-ellipsis">
            <img src="{{asset('upload/'.$all_don->image)}}" alt="lỗi" height="145" width="200">
                  
            </span> </a></td>
            <td><a href=""><span class="text-ellipsis">
                {{$all_don->congTy_ten}}

            </span></a></td>  
            <td style="width: 123px;text-align:center">
              <a href="{{ route('admin.don_detail',['don_id' => $all_don->don_id]) }}"
                 class="active btn btn-sm btn-success " ui-toggle-class="">
                 <i class="fa-solid fa-eye" style="font-size: 18px;"></i>
              </a>
              @if($all_don->loai_id<4)
                <a href="{{ route('admin.edit_category',['don_id' => $all_don->don_id]) }}"
                  class="active btn btn-sm btn-success " ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                </a>
              @elseif($all_don->loai_id==4)
              <a href="{{ route('admin.edit_don_KD',['don_id' => $all_don->don_id]) }}"
                  class="active btn btn-sm btn-success " ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                </a>
              @else
              <a href="{{ route('admin.edit_don_GPHI',['don_id' => $all_don->don_id]) }}"
                  class="active btn btn-sm btn-success " ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                </a>
              @endif
              <a href="{{  route('admin.delete_category',['don_id'=>$all_don->don_id,'congTy_id'=>$all_don->congTy_id]) }}" 
              onclick="return confirm('Bạn có chắc muốn xóa đơn này không?')"
              class="edit btn btn-sm btn-danger" ui-toggle-class="">
                <i class="fa fa-times text" style="font-size: 18px;"></i>
              </a>
            </td>
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
    
     <footer class="panel-footer">
       <div class="row">
        
          <div class="col-sm-5 text-center">
            
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
          </div>
      </div>
       
    </footer>
  </div>
 
</div>


@endsection