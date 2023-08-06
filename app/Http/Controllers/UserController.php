<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use PHPExcel;
use PHPExcel_IOFactory;
session_start();
class UserController extends Controller
{
    public function index(){
       
        return view('user.dashboard');
    }
    public function showDashboard(){
       
        return view('user.dashboard');
    }

    public function all_don(Request $request){
        $search = $request->search ?? '';
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $data=$request;
        $don=DB::table('don')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->get();

        if($request->huyen!=0){
            $don=$don->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $don=$don->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $don=$don->where('nam',$request->nam);
        }       
        
        return view('user.all_don')->with('don', $don)
                                    ->with('data', $data)
                                    ->with('huyen',$huyen)
                                    ->with('loai',$loai);
    

    }
    public function all_bang(Request $request){
        $search = $request->search ?? '';
        $data=$request;
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        /* $all_brand_product = DB::table('brand')->where('brand_name','like',"%$search%")->paginate(5); */ 
        $all_bang = DB:: table('bang')->join('don','bang.don_id','don.don_id')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->orwhere('bang.bang_id','like',"%$search%")
                            ->get();
        if($request->huyen!=0){
            $all_bang=$all_bang->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $all_bang=$all_bang->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $all_bang=$all_bang->where('nam',$request->nam);
        }
                
        
        return view('user.all_bang')
                                    ->with('data', $data)
                                    ->with('huyen',$huyen)
                                    ->with('loai',$loai)
                                    ->with('all_bang', $all_bang);
    }

    public function don_detail($don_id){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $nhom=DB::table('nhom')->get();
        $don_detail=DB::table('don')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id',$don_id)->get();
        $nhom_detail=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();
        
        return view('user.don_detail')->with('nhom_detail',$nhom_detail)
                                                ->with('don_detail',$don_detail)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }

    public function bang_detail($bang_id,$don_id){
        $congTy=DB::table('congty')->get();
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        $nhom=DB::table('nhom')->get();
        $bang_detail=DB::table('bang')->join('don','don.don_id','bang.don_id')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('bang.bang_id',$bang_id)->get();
        $nhom_detail=DB::table('nhom')->join('nhomLienKet','nhomLienKet.nhom_id','nhom.nhom_id')
                                    ->where('nhomLienKet.don_id',$don_id)->get();

        return view('user.bang_detail')->with('nhom_detail',$nhom_detail)
                                                ->with('bang_detail',$bang_detail)
                                                ->with('huyen',$huyen)
                                                ->with('nhom',$nhom)
                                                ->with('congty',$congTy);
    }

    public function don_print_to_excel(Request $request){

        $search = $request->search ?? '';
        $data=$request;
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        
        $all_don = DB:: table('don')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->get();
        if($request->huyen!=0){
            $all_don=$all_don->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $all_don=$all_don->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $all_don=$all_don->where('nam',$request->nam);
        }
        
        
		$excel = new PHPExcel();
		$excel->createSheet();
		$activeSheet = $excel->setActiveSheetIndex(1);
		$activeSheet->setTitle( "Dữ liệu đơn" );

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(90);
		

		$excel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);

		$activeSheet->setCellValue('A2', 'STT')
			->setCellValue('B2', 'Số đơn')
			->setCellValue('C2', 'Mã đơn')
			->setCellValue('D2', 'Ngày nộp đơn')
			->setCellValue('E2', 'Ngày công bố đơn')
			->setCellValue('F2', 'Tên đơn vị nộp đơn')
			->setCellValue('G2', 'Địa chỉ' )
            ->setCellValue('H2', 'Thông tin các nhóm  bảo hộ' );

            

		$numRow = 3;
		$stt = 1;
		foreach ($all_don as $value) {
                $nhom=DB::table('don')->where('don.don_id',$value->don_id)
                                ->join('nhomLienKet','don.don_id','nhomLienKet.don_id')
                                ->join('nhom','nhom.nhom_id','nhomLienKet.nhom_id')->get();
                $nhom_data=""; 
                foreach($nhom as $nhom){
                    $nhom_data=$nhom_data.$nhom->nhom_ten.": ".$nhom->chiTiet."\n";
                }
                $stt_string=''.$stt;
				$excel->getActiveSheet()->setCellValue('A' . $numRow, $stt_string);
			    $excel->getActiveSheet()->setCellValue('B' . $numRow, $value->don_soDon);			    
			    $excel->getActiveSheet()->setCellValue('C' . $numRow, $value->don_id );
			    $excel->getActiveSheet()->setCellValue('D' . $numRow, $value->ngayNop );
			    $excel->getActiveSheet()->setCellValue('E' . $numRow, $value->ngayCongBo);
			    $excel->getActiveSheet()->setCellValue('F' . $numRow, $value->congTy_ten);
			    $excel->getActiveSheet()->setCellValue('G' . $numRow, $value->congTy_diaChi );
                $excel->getActiveSheet()->setCellValue('H' . $numRow, $nhom_data );

			    $numRow++;

			    
				$stt++;
		}
        //PHPExcel_IOFactory::createWriter($excel, 'Excel5')->save('duLieuBang.xlsx');

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="duLieuDon.xls"');
        ob_end_clean();
		PHPExcel_IOFactory::createWriter($excel, 'Excel5')->save('php://output'); //Khi up site thày thành Excel5

        
    }

    public function bang_print_to_excel(Request $request){

        $search = $request->search ?? '';
        $data=$request;
        $huyen=DB::table('huyen')->get();
        $loai=DB::table('loai')->get();
        /* $all_brand_product = DB::table('brand')->where('brand_name','like',"%$search%")->paginate(5); */ 
        $all_bang = DB:: table('bang')->join('don','bang.don_id','don.don_id')->join('congty','congty.congTy_id','don.congTy_id')->join('huyen','congty.huyen_id','huyen.huyen_id')
                            ->where('don.don_id','like',"%$search%")
                            ->orwhere('congty.congTy_ten','like',"%$search%")
                            ->orwhere('congty.congTy_diaChi','like',"%$search%")
                            ->orwhere('huyen.huyen_ten','like',"%$search%")
                            ->orwhere('bang.bang_id','like',"%$search%")
                            ->get();
        if($request->huyen!=0){
            $all_bang=$all_bang->where('huyen_id',$request->huyen);
        }
        if($request->loai!=0){
            $all_bang=$all_bang->where('loai_id',$request->loai);
        }
        if($request->nam!=0){
            $all_bang=$all_bang->where('nam',$request->nam);
        }
        
        
		$excel = new PHPExcel();
		$excel->createSheet();
		$activeSheet = $excel->setActiveSheetIndex(1);
		$activeSheet->setTitle( "Dữ bằng NH,NHTT,NHCN,CDĐL" );

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(90);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(90);
        $excel->getActiveSheet()->getColumnDimension('j')->setWidth(30);

		$excel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);

		$activeSheet->setCellValue('A2', 'STT')
			->setCellValue('B2', '(111) Mã bằng')
			->setCellValue('C2', '(151) Ngày cấp bằng bằng')
			->setCellValue('D2', '(210) Mã đơn')
			->setCellValue('E2', '(220) Ngày nộp đơn')
			->setCellValue('F2', '(181) Ngày hết hạn hiệu lực')
			->setCellValue('G2', '(450) Ngày công bố bằng')
			->setCellValue('H2', '(731) Tên đơn vị nộp đơn')
			->setCellValue('I2', '(731) Địa chỉ' )
            ->setCellValue('j2', '(511) Thông tin các nhóm  bảo hộ' );

            

		$numRow = 3;
		$stt = 1;
		foreach ($all_bang as $value) {
                $nhom=DB::table('bang')->where('bang_id',$value->bang_id)->join('don','don.don_id','bang.don_id')
                                ->join('nhomLienKet','don.don_id','nhomLienKet.don_id')
                                ->join('nhom','nhom.nhom_id','nhomLienKet.nhom_id')->get();
                $nhom_data=""; 
                foreach($nhom as $nhom){
                    $nhom_data=$nhom_data.$nhom->nhom_ten.": ".$nhom->chiTiet."\n";
                }
                $stt_string=''.$stt;
				$excel->getActiveSheet()->setCellValue('A' . $numRow, $stt_string);
			    $excel->getActiveSheet()->setCellValue('B' . $numRow, $value->bang_id);
			    $excel->getActiveSheet()->setCellValue('C' . $numRow, $value->ngayCap );			    
			    $excel->getActiveSheet()->setCellValue('D' . $numRow, $value->don_id );
			    $excel->getActiveSheet()->setCellValue('E' . $numRow, $value->ngayNop );
			    $excel->getActiveSheet()->setCellValue('F' . $numRow, $value->ngayKetThuc);
			    $excel->getActiveSheet()->setCellValue('G' . $numRow, $value->ngayHieuLuc);
			    $excel->getActiveSheet()->setCellValue('H' . $numRow, $value->congTy_ten);
			    $excel->getActiveSheet()->setCellValue('I' . $numRow, $value->congTy_diaChi );
                $excel->getActiveSheet()->setCellValue('J' . $numRow, $nhom_data );

			    $numRow++;

			    
				$stt++;
		}
        //PHPExcel_IOFactory::createWriter($excel, 'Excel5')->save('duLieuBang.xlsx');

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="duLieuBang.xls"');
        ob_end_clean();
		PHPExcel_IOFactory::createWriter($excel, 'Excel5')->save('php://output'); //Khi up site thày thành Excel5

        
        

    
  
  }

}
