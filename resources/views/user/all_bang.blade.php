@extends('user_layout')
@section('user_content')
<style>
.edit{
  color: #fff!important;

}
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
    <div class="panel-heading">
      Liệt kê Bằng
    </div>
    
    <div class="row w3-res-tb">
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
        
        <br>
        
        <a href="{{ route('user.bang_print_to_excel') }}"
                 class="active btn btn-sm btn-success " ui-toggle-class="">
                 Xuất ra excel
</a>
                 
                            
      </div>
      </form>
      
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã Bằng</th>
            <th>Mã Đơn</th>
            <th>Hình ảnh</th>
            <th>Đơn vị nộp Đơn</th>
            <th >Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_bang as $key=>$bang)
          <tr>
           
            <td><a href="">{{$bang->bang_id}}</a></td>
            <td><a href="">{{$bang->don_id}}</a></td>
            <td><a href=""><span class="text-ellipsis">
            <img src="{{asset('upload/'.$bang->image)}}" alt="Bằng này không có hình ảnh" height="145" width="200">
                  
            </span> </a></td>
            <td><a href=""><span class="text-ellipsis">
                {{$bang->congTy_ten}}

            </span></a></td>  
            <td style="width: 123px;text-align:center">
            <a href="{{ route('user.bang_detail',['bang_id' => $bang->bang_id ,'don_id' => $bang->don_id ]) }}"
                 class="active btn btn-sm btn-success " ui-toggle-class="">
                 <i class="fa fa-solid fa-eye"  style="font-size: 18px;"></i>
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