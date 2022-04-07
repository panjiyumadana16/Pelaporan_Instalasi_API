<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Installation as InstallationResource;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Installation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstallationController extends BaseController
{
    public function index()
    {
        $installations = Installation::where('status', 1)->get();
        return $this->sendResponse(InstallationResource::collection($installations), 'Tampil data berhasil!');
    }

    public function countData()
    {
        $installations = COUNT(Installation::where('status', 1)->get());
        return response()->json($installations);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // $input['code'] = strtoupper(substr(md5(time()), 0, 5));
        // $input['status'] = 1;
        $installation = Installation::insert([
            'code'                  => $request->code,
            'number_of_technicians' => $request->number_of_technicians,
            'category_instansi'     => $request->category_instansi,
            'technician_id'         => $request->technician_id,
            'date_instalation'      => $request->date_instalation,
            'pic_name'              => $request->pic_name,
            'pic_phone'            => $request->pic_number,
            'status'                => '1',
            'alamat'                => $request->alamat,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        return response()->json($installation);
    }

    public function show($id)
    {
        $installation = DB::select("
            SELECT i.*, t.*, i.id as id_instalation
            FROM installations i, technicians t
            WHERE i.id = $id AND i.technician_id = t.id
        ");
        // $installation = Installation::join('technicians', 'installations.technician_id', '=', 'technicians.id')->where('installations.id', $id)->first();
        if (is_null($installation)) {
            return $this->sendError('Data instalasi tidak ditemukan!');
        }
        // return $this->sendResponse(new InstallationResource($installation), 'Data Instalasi ada!');
        return response()->json($installation);
    }

    public function update(Request $request, $id)
    {
        $installation = Installation::find($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'number_of_technicians' => 'required',
            'category_instansi' => 'required',
            'technician_id' => 'required',
            'date_instalation' => 'required|date',
            'status' => 'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $installation->number_of_technicians = $input['number_of_technicians'];
        $installation->category_instansi = $input['category_instansi'];
        $installation->technician_id = $input['technician_id'];
        $installation->date_instalation = $input['date_instalation'];
        $installation->pic_name = $input['pic_name'];
        $installation->pic_phone = $input['pic_phone'];
        $installation->status = $input['status'];
        $installation->save();

        return $this->sendResponse(new InstallationResource($installation), 'Update Data Instalasi berhasil!');
    }

    public function destroy($id)
    {
        $installation = Installation::find($id);
        $installation->delete();
        return $this->sendResponse([], 'Hapus Data Instalasi berhasil!');
    }
}
