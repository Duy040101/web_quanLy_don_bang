@extends('user_layout')
@section('user_content')

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
            @foreach($bang_detail as $detail)
                @if($detail->loai_id<=4)
                    <section class="panel">
                        <header class="panel-heading">
                            Thông tin bằng {{$detail->don_id}}
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                        <tr>
                                            <th>(111)</th>
                                            <td>{{$detail->bang_id}}</td>
                                            <th>(151)</th>
                                            <td>{{$detail->ngayCap}}</td>
                                        </tr>
                                        <tr>
                                            <th>(210): </th>
                                            <td >{{$detail->don_id}}</td>
                                            <th>(220):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        </tr>
                                        <tr>
                                            <th>(181)</th>
                                            <td colspan="3">{{$detail->ngayKetThuc}}</td>
                                        </tr>
                                        <tr>
                                            <th>(450)</th>
                                            <td colspan="3">{{$detail->ngayHieuLuc}}</td>
                                        </tr>
                                        <tr>
                                            <th>(540):</th>
                                            <td rowspan="5"> <img src="{{asset('upload/'.$detail->image)}}" alt=""  style="max-height: 600px;max-width:90%"></td>
                                            <th>(731):</th>
                                            <td rowspan="2">{{$detail->congTy_ten}} <br>
                                            <div style="left: 10px;">{{$detail->congTy_diaChi}}</div>
                                            
                                            </td>
                                           
                                        </tr>
                                        
                                        <tr>
                                            <th rowspan="4"></th>
                                            
                                            <th rowspan="2"></th>
                                        </tr>
                                            
                                        </tr>
                                       
                                        <tr>
                                            
                                        </tr>
                                        <tr > 
                                            
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
                                            <td colspan="4">
                                               
                                            </td>
                                        </tr>
                                    </table>
                                    
                              
                                </div>

                            </div>
                    </section>
                @elseif($detail->loai_id==5)
                <section class="panel">
                        <header class="panel-heading">
                            Thông tin bằng {{$detail->don_id}} KD
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                       <tr>
                                            <th>(11): </th>
                                            <td colspan="3">{{$detail->bang_id}}</td>
                                           
                                        </tr>
                                        <tr>
                                            <th>(15): </th>
                                            <td colspan="3">{{$detail->ngayCap}}</td>
                                           
                                        </tr>
                                        <tr>
                                        <tr>
                                            <th>(21):</th>
                                            <td > {{$detail->don_id}}</td>
                                            <th>(22):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        </tr>
                                        <tr>
                                            <th>(18):</th>
                                            <td colspan="3">{{$detail->ngayKetThuc}}</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>(54):</th>
                                            <td colspan="3"> {{$detail->don_tenSP}}</td>
                                        </tr>
                                        <tr>
                                        <th>(45):</th>
                                            <td> {{$detail->ngayHieuLuc}}</td>
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
                                            <td colspan="4">

                                               
                                            </td>
                                        </tr>
                                    </table>
                                    
                              
                                </div>

                            </div>
                    </section>
                    @elseif($detail->loai_id==6)
                    <section class="panel">
                        <header class="panel-heading">
                            Thông Tin bằng {{$detail->don_id}} (GPHI/SC)
                        </header>
                       
                            <div class="panel-body">
                                @include('common.alert')
                                <div class="position-center">
                                    <table>
                                        <tr>
                                            <th>(11): </th>
                                            <td colspan="3">{{$detail->bang_id}}</td>
                                           
                                        </tr>
                                        <tr>
                                            <th>(15):</th>
                                            <td colspan="3"> {{$detail->ngayCap}}</td>
                                        </tr>
                                        <tr>
                                        <th>(21):</th>
                                            <td > {{$detail->don_id}}</td>

                                        <th>(22):</th>
                                            <td> {{$detail->ngayNop}}</td>
                                        
                                        </tr>
                                        <tr>
                                        <th>(45):</th>
                                            <td> {{$detail->ngayHieuLuc}}</td>
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
                                            <td colspan="4">

                                               
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