@extends('user_layout')
@section('user_content')
<style>
.edit{
  color: #fff!important;

}
</style>
<div class="table-agile-info" style="margin:0px">
  <div class="panel panel-default">
    @include('common.alert')
  
    
    <img src="{{asset('upload/'.'title.jpg')}}" alt="">
    
    <div class="row w3-res-tb">
        <br>
    <header class="panel-heading" style="font-size:45px;height:200px;margin:30px"> <br>
                            Website quản lý đơn bằng sở hữu công nghiệp được cấp tại tỉnh hậu giang
                            <br>
                        </header>
        
    </div>
    
  </div>
 
</div>


@endsection