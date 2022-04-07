<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Report_Installation as RInstallationResource;
use App\Models\Installation;
use App\Models\Report_component;
use App\Models\Report_installation;
use App\Models\Report_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class Report_InstallationController extends BaseController
{
    public function index()
    {
        $rinstallation = Report_installation::join('installations', 'report_installations.installation_id', '=', 'installations.id')->get();
        return $this->sendResponse(RInstallationResource::collection($rinstallation), 'Tampil data berhasil!');
    }

    public function show($id)
    {
        $rinstallation = DB::select("
            SELECT i.*, ri.*, rc.*, c.*
            FROM installations i, report_installations ri, report_components rc, components c
            WHERE ri.installation_id = $id AND i.id = ri.installation_id AND rc.report_id = ri.id AND rc.component_id = c.id
        ");
        if (is_null($rinstallation)) {
            return $this->sendError('Data tidak ditemukan!');
        }
        return response()->json([
            'data' => $rinstallation
        ]);
    }

    public function checkData($id)
    {
        $rinstallation = DB::select("
            SELECT i.*, ri.*, rc.*, c.*, DATE_FORMAT(ri.start_installation, '%Y-%m-%d') as startI_date,
             DATE_FORMAT(ri.start_training, '%Y-%m-%d') as startT_date, DATE_FORMAT(ri.completed_installation, '%Y-%m-%d') as completeI_date, DATE_FORMAT(ri.complete_training, '%Y-%m-%d') as completeT_date
            FROM installations i, report_installations ri, report_components rc, components c
            WHERE ri.installation_id = $id AND i.id = ri.installation_id AND rc.report_id = ri.id AND rc.component_id = c.id
        ");

        return response()->json($rinstallation);
    }

    public function checkFoto($id)
    {
        $data = Report_photo::where([['report_id', $id], ['type', 'Foto']])->get();

        return response()->json($data);
    }

    public function checkFotoBast($id)
    {
        $data = Report_photo::where([['report_id', $id], ['type', 'Bast']])->get();

        return response()->json($data);
    }
    
    public function checkVideo($id)
    {
        $data = Report_Installation::where('installation_id', $id)->value('video');
        return response()->json($data);

    }

    public function store(Request $request, $id)
    {
        $checkRI = Report_installation::where('installation_id', $id)->first();
        
        if(!is_null($checkRI)){
            $checkCom1 = Report_component::where([['report_id', $id], ['component_id', 1]])->first();
            $checkCom2 = Report_component::where([['report_id', $id], ['component_id', 2]])->first();
            $checkCom3 = Report_component::where([['report_id', $id], ['component_id', 3]])->first();
            $checkCom4 = Report_component::where([['report_id', $id], ['component_id', 4]])->first();
            $checkCom5 = Report_component::where([['report_id', $id], ['component_id', 5]])->first();
            
            $updateR = Report_installation::where('installation_id', $id)->update([
                        'start_installation'    => $request->tglMulaiInstalasi,
                        'completed_installation' => $request->tglSelesaiInstalasi,
                        'start_training'        => $request->tglMulaiTraining,
                        'complete_training'     => $request->tglSelesaiTraining,
                        'condition'             => $request->kondisi,
                        'problem'               => $request->problem,
                        'anydesk_id'            => $request->idAnydesk,
                        'status'                => 1
                    ]);

            if($checkCom1){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 1]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 1
                    ]);
                }
            }
            if($checkCom2){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 2]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 2
                    ]);
                }
            }
            if($checkCom3){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 3]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 3
                    ]);
                }
            }
            if($checkCom4){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 4]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 4
                    ]);
                }
            }
            if($checkCom5){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 5]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 5
                    ]);
                }
            }

            return response()->json($updateR);
        }else{
            $reportI = new Report_installation;
            $reportI->installation_id       = $id;
            $reportI->start_installation    = $request->tglMulaiInstalasi;
            $reportI->completed_installation = $request->tglSelesaiInstalasi;
            $reportI->start_training        = $request->tglMulaiTraining;
            $reportI->complete_training     = $request->tglSelesaiTraining;
            $reportI->condition             = $request->kondisi;
            $reportI->problem               = $request->problem;
            $reportI->anydesk_id            = $request->idAnydesk;
            $reportI->status                = '1';
            $reportI->save();


            if($request->tiketing == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 1
                ]);
            }
            if($request->caller == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 2
                ]);
            }
            if($request->digitalSignage == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 3
                ]);
            }
            if($request->hardware == true){
                Report_component::insert([
                    'report_id'     => $reportI->idd,
                    'component_id'  => 4
                ]);
            }
            if($request->jaringan == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 5
                ]);
            }

            return response()->json([
                'Report' => $reportI,
                'message'   => 'Success'
            ]);
        }
        
    }

    public function storeSave(Request $request, $id)
    {
        $checkRI = Report_installation::where('installation_id', $id)->first();
        
        if(!is_null($checkRI)){
            $checkCom1 = Report_component::where([['report_id', $id], ['component_id', 1]])->first();
            $checkCom2 = Report_component::where([['report_id', $id], ['component_id', 2]])->first();
            $checkCom3 = Report_component::where([['report_id', $id], ['component_id', 3]])->first();
            $checkCom4 = Report_component::where([['report_id', $id], ['component_id', 4]])->first();
            $checkCom5 = Report_component::where([['report_id', $id], ['component_id', 5]])->first();
            
            if($checkCom1){
                if($request->tiketing == false){
                    Report_component::where([['report_id', $id], ['component_id', 1]])->delete();   
                }
            }else{
                if($request->tiketing == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 1
                    ]);
                }
            }
            if($checkCom2){
                if($request->caller == false){
                    Report_component::where([['report_id', $id], ['component_id', 2]])->delete();   
                }
            }else{
                if($request->caller == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 2
                    ]);
                }
            }
            if($checkCom3){
                if($request->digitalSignage == false){
                    Report_component::where([['report_id', $id], ['component_id', 3]])->delete();   
                }
            }else{
                if($request->digitalSignage == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 3
                    ]);
                }
            }
            if($checkCom4){
                if($request->hardware == false){
                    Report_component::where([['report_id', $id], ['component_id', 4]])->delete();   
                }
            }else{
                if($request->hardware == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 4
                    ]);
                }
            }
            if($checkCom5){
                if($request->jaringan == false){
                    Report_component::where([['report_id', $id], ['component_id', 5]])->delete();   
                }
            }else{
                if($request->jaringan == true){
                    Report_component::insert([
                        'report_id'     => $checkRI->id,
                        'component_id'  => 5
                    ]);
                }
            }
            
            $updateR = Report_installation::where('installation_id', $id)->update([
                'start_installation'    => $request->tglMulaiInstalasi,
                'completed_installation' => $request->tglSelesaiInstalasi,
                'start_training'        => $request->tglMulaiTraining,
                'complete_training'     => $request->tglSelesaiTraining,
                'condition'             => $request->kondisi,
                'problem'               => $request->problem,
                'anydesk_id'            => $request->idAnydesk,
                'status'                => '2'
            ]);

            Installation::where('id',$id)->update([
                'status'    => 2
            ]);
            return response()->json($updateR);

        }else{
            $reportI = new Report_installation;
            $reportI->installation_id       = $id;
            $reportI->start_installation    = $request->tglMulaiInstalasi;
            $reportI->completed_installation = $request->tglSelesaiInstalasi;
            $reportI->start_training        = $request->tglMulaiTraining;
            $reportI->complete_training     = $request->tglSelesaiTraining;
            $reportI->condition             = $request->kondisi;
            $reportI->problem               = $request->problem;
            $reportI->anydesk_id            = $request->idAnydesk;
            $reportI->status                = '2';
            $reportI->save();


            if($request->tiketing == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 1
                ]);
            }
            if($request->caller == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 2
                ]);
            }
            if($request->digitalSignage == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 3
                ]);
            }
            if($request->hardware == true){
                Report_component::insert([
                    'report_id'     => $reportI->idd,
                    'component_id'  => 4
                ]);
            }
            if($request->jaringan == true){
                Report_component::insert([
                    'report_id'     => $reportI->id,
                    'component_id'  => 5
                ]);
            }

            Installation::where('id',$id)->update([
                'status'    => 2
            ]);

            return response()->json([
                'Report' => $reportI,
                'message'   => 'Success'
            ]);
        }
        
    }

    public function destroy($id)
    {
        $rinstallation = Report_installation::find($id);
        $rinstallation->delete();

        return $this->sendResponse([], 'Hapus data berhasil!');
    }

    public function uploadVideo(Request $request, $id)
    {
        $video = $request->file('video');
        return response()->json($request);


        if ($video) {
            $filename = time(). '.'.$video->getClientOriginalExtension();
            $video->move('video/', $filename);
            $rinstallation = Report_installation::where('installation_id', $id)->first();
            if (is_null($rinstallation)) {
                return $this->sendError('Data tidak ditemukan!');
            }
            $upload = Report_installation::where('installation_id', $id)->update([
                'video' => $video
            ]);
            return $this->sendResponse(new RInstallationResource($rinstallation), 'Input data Instalasi berhasil!');
        } else {
            return $this->sendError([], 'File bukan video', 201);
        }
    }

    public function uploadFoto(Request $request, $id)
    {
        $photos = $request->file('photos');
        

        if ($photos) {
            $filename = time(). '.'.$photos->getClientOriginalExtension();
            $photos->move('uploads/', $filename);
            $return = Report_photo::create([
                'report_id' => $id,
                'type'      => 'Foto',
                'photos' => $filename
            ]);
            return $this->sendResponse($return, 'Input data Instalasi berhasil!');
        } else {
            // return $this->sendError([$photos], 'File bukan photo', 201);
            return response()->json([
                'photos'    => $photos,
                'message'   => 'File Bukan Foto!'
            ]);
        }
    }

    public function uploadFotoBast(Request $request, $id)
    {
        $photos = $request->file('photos');
        

        if ($photos) {
            $filename = time(). '.'.$photos->getClientOriginalExtension();
            $photos->move('uploads/', $filename);
            $return = Report_photo::create([
                'report_id' => $id,
                'type'      => 'Bast',
                'photos' => $filename
            ]);
            return $this->sendResponse($return, 'Input data Instalasi berhasil!');
        } else {
            // return $this->sendError([$photos], 'File bukan photo', 201);
            return response()->json([
                'photos'    => $photos,
                'message'   => 'File Bukan Foto!'
            ]);
        }
    }

    public function componentCheckbox(Request $request, $id)
    {
        $input = $request->all();
        $rinstallation = Report_installation::find($id);
        if (is_null($rinstallation)) {
            return $this->sendError('Data tidak ditemukan!');
        }

        $set = array();

        if (isset($input['ticketing'])) {
            array_push($set, "1");
        } else {
            Report_component::where('report_id', $id)->where('component_id', '1')->delete();
        }
        if (isset($input['caller'])) {
            array_push($set, "2");
        } else {
            Report_component::where('report_id', $id)->where('component_id', '2')->delete();
        }
        if (isset($input['digital_signame'])) {
            array_push($set, "3");
        } else {
            Report_component::where('report_id', $id)->where('component_id', '3')->delete();
        }
        if (isset($input['hardware'])) {
            array_push($set, "4");
        } else {
            Report_component::where('report_id', $id)->where('component_id', '4')->delete();
        }
        if (isset($input['jaringan'])) {
            array_push($set, "5");
        } else {
            Report_component::where('report_id', $id)->where('component_id', '5')->delete();
        }

        foreach ($set as $data) {

            $cek = Report_component::where('report_id', $id)->where('component_id', $data)->count();

            if ($cek < 1) {
                Report_component::create([
                    'report_id' => $id,
                    'component_id' => $data,
                ]);
            }
        }
        return $this->sendResponse([], 'Berhasil menambahkan komponen!');
    }

    public function showComp($id, $comp_id)
    {
        $rcomp = Report_component::where('report_id', $id)->where('component_id', $comp_id)->get();
        if ($rcomp->count() == 0) {
            return $this->sendError('Data tidak ditemukan!');
        }
        return $this->sendResponse($rcomp, 'Data component ada!');
    }
}
