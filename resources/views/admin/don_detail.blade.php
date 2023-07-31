@extends('admin_layout')
@section('admin_content')

<style>
    td{
        width:40%;
    }
    th{
        width:10%;
    }
    table{
        width:100%
    }
</style>

<div class="row">
    {{csrf_field()}}
            <div class="col-lg-12">
            @foreach($don_detail as $detail)
                @if($detail->loai_id<=4)
                    <section class="panel">
                        <header class="panel-heading">
                            Thông Tin đơn {{$detail->don_id}}
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                        <tr>
                                            <th>(210): </th>
                                            <td >{{$detail->don_id}}</td>
                                            <th>(220):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        </tr>
                                        <tr>
                                            <th>(540):</th>
                                            <td rowspan="5"> <img src="{{asset('upload/'.$detail->image)}}" alt=""  style="max-height: 600px;max-width:90%"></td>
                                            <th>(441):</th>
                                            <td> {{$detail->ngayCongBo}}</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <th rowspan="4"></th>
                                        </tr>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <th>(731):</th>
                                            <td rowspan="2">{{$detail->congTy_ten}} <br>
                                            <div style="left: 10px;">{{$detail->congTy_diaChi}}</div>
                                            </td>
                                        </tr>
                                        <tr > 
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                           
                                        </tr>
                                        <tr>
                                            <th>(511):</th>
                                            <td colspan="3">
                                                @foreach($nhom_detail as $nhom)
                                                <a href="" data-toggle="modal"
                                                data-target="#myModal{{$nhom->nhom_id}}">{{$nhom->nhom_ten}}</a>: {{$nhom->chiTiet}}
                                                <!-- Modal chọn các nhóm -->
                                                    <div class="modal fade" id="myModal{{$nhom->nhom_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <a type="submit" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></a>
                                                                        <h2 class="modal-title" id="myModalLabel">Thông tin nhóm {{$nhom->nhom_id}}</h2>
                                                                    </div>
                                                                    <div class="modal-body">
                                                    
                                                                        <div class="form-one" style="width:100%">
                                                                            {{$nhom->nhom_chiTiet}}

                                                                        </div>
                                                                        <div class="modal-footer ">
                                                                            <button type="button" class="btn btn-info" data-dismiss="modal"
                                                                                style="margin-top:10px">Đóng</button>
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                    </div>
                                        
                                                            </div>
                                                        </div>
                                                 </div> <br>
                                                @endforeach
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4"><br></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><a href="{{ route('admin.edit_category',['don_id' => $detail->don_id]) }}"
                                                class="active btn btn-sm btn-success " ui-toggle-class="">
                                                Chỉnh sửa <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                                                </a>
                                            
                                            
                                            
                                                <a href="{{  route('admin.delete_category',['don_id'=>$detail->don_id,'congTy_id'=>$detail->congTy_id]) }}" 
                                                onclick="return confirm('Bạn có chắc muốn xóa Đơn này không?')"
                                                class="edit btn btn-sm btn-danger" ui-toggle-class="">
                                                    Xóa <i class="fa fa-times text" style="font-size: 18px;"></i>
                                                </a>

                                               
                                            </td>
                                        </tr>
                                    </table>
                                    
                              
                                </div>

                            </div>
                    </section>
                @elseif($detail->loai_id==5)
                <section class="panel">
                        <header class="panel-heading">
                            Thông Tin đơn {{$detail->don_id}} KD
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                       <tr>
                                            <th>(11): </th>
                                            <td colspan="3">{{$detail->don_soDon}}</td>
                                           
                                        </tr>
                                        <tr>
                                            <th>(21):</th>
                                            <td colspan="3"> {{$detail->don_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>(54):</th>
                                            <td colspan="3"> {{$detail->don_tenSP}}</td>
                                        </tr>
                                        <th>(22):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        <th>(43):</th>
                                            <td> {{$detail->ngayCongBo}}</td>
                                        </tr>
                                        <tr >
                                            <th>(73):</th>
                                            <td colspan="3" rowspan="">{{$detail->congTy_ten}} 
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <th ></th>
                                            <td colspan="3"><div style="left: 10px;">{{$detail->congTy_diaChi}}</div></td>
                                        </tr>
                                        <tr >
                                            <th>(72):</th>
                                            <td colspan="3">{{$detail->don_tenTG}}
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                        <th colspan="4">(55):</th>
                                        </tr>
                                        <tr>
                                            
                                            <td colspan="4"> <img src="{{asset('upload/'.$detail->image)}}" alt=""  style="max-width:90%"></td>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4"><br></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><a href="{{ route('admin.edit_don_KD',['don_id' => $detail->don_id]) }}"
                                                class="active btn btn-sm btn-success " ui-toggle-class="">
                                                Chỉnh sửa <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                                                </a>
                                            
                                            
                                            
                                                <a href="{{  route('admin.delete_category',['don_id'=>$detail->don_id,'congTy_id'=>$detail->congTy_id]) }}" 
                                                onclick="return confirm('Bạn có chắc muốn xóa Đơn này không?')"
                                                class="edit btn btn-sm btn-danger" ui-toggle-class="">
                                                    Xóa <i class="fa fa-times text" style="font-size: 18px;"></i>
                                                </a>

                                               
                                            </td>
                                        </tr>
                                    </table>
                                    
                              
                                </div>

                            </div>
                    </section>
                    @elseif($detail->loai_id==6)
                    <section class="panel">
                        <header class="panel-heading">
                            Thông Tin đơn {{$detail->don_id}} (GPHI/SC)
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                        <tr>
                                            <th>(11): </th>
                                            <td colspan="3">{{$detail->don_soDon}}</td>
                                           
                                        </tr>
                                        <tr>
                                            <th>(21):</th>
                                            <td colspan="3"> {{$detail->don_id}}</td>
                                        </tr>
                                        
                                        <th>(22):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        <th>(43):</th>
                                            <td> {{$detail->ngayCongBo}}</td>
                                        </tr>
                                        <tr >
                                            <th>(73):</th>
                                            <td colspan="3" rowspan="">{{$detail->congTy_ten}} 
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <th ></th>
                                            <td colspan="3"><div style="left: 10px;">{{$detail->congTy_diaChi}}</div></td>
                                        </tr>
                                        <tr >
                                            <th>(72):</th>
                                            <td colspan="3">{{$detail->don_tenTG}}
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>(54):</th>
                                            <td colspan="3"> {{$detail->don_tenSP}}</td>
                                        </tr>
                                        <tr>
                                            <th >(57):</th>
                                            <td colspan="3"> {{$detail->don_tomTat}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th rowspan="2"></th>
                                        </tr>
                                        @if($detail->image)
                                        <tr>
                                            
                                            <td colspan="3"> <img src="{{asset('upload/'.$detail->image)}}" alt=""  style="max-width:90%"></td>
                                            </td>
                                            
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="4"><br></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><a href="{{ route('admin.edit_don_GPHI',['don_id' => $detail->don_id]) }}"
                                                class="active btn btn-sm btn-success " ui-toggle-class="">
                                                Chỉnh sửa <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
                                                </a>
                                            
                                            
                                            
                                                <a href="{{  route('admin.delete_category',['don_id'=>$detail->don_id,'congTy_id'=>$detail->congTy_id]) }}" 
                                                onclick="return confirm('Bạn có chắc muốn xóa Đơn này không?')"
                                                class="edit btn btn-sm btn-danger" ui-toggle-class="">
                                                    Xóa <i class="fa fa-times text" style="font-size: 18px;"></i>
                                                </a>

                                               
                                            </td>
                                        </tr>
                                    </table>
                                    
                              
                                </div>

                            </div>
                    </section>
                @endif
            @endforeach  
            </div>
          
        </div>
@endsection