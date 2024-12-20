<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Pembayaran; 

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SharingSession;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    private $user;
    
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        return view('pembayaran');
    }

    public function viewAdmin()
    {
        return view('pembayaran'); 
    }
    public function tableAdmin()
    {
        $pembayarans = Pembayaran::with(['customer', 'worker']) 
        ->orderByDesc('id');

        return DataTables::of($pembayarans)
            ->addColumn('no', function ($row) {
                static $counter = 0;
                return ++$counter;
            })
            ->addColumn('nama_customer', function ($row) {
                return $row->customer->name;
            })
            ->addColumn('nama_worker', function ($row) {
                return $row->worker->name;
            })
            ->addColumn('status_konsul', function ($row) {
                $badge = $row->status_konsul == 'proses' ? 'warning' : 'primary';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->status_konsul . '</span>';
            })
            ->addColumn('sharing_session', function ($row) {
                $badge = $row->sharing_session == 'offline' ? 'info' : 'primary';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->sharing_session . '</span>';
            })
            ->addColumn('status_bayar', function ($row) {
                $badge = $row->status_bayar == 'paid' ? 'success' : 'danger';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->status_bayar . '</span>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-success info-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#info-modal">
                        <i class="ti ti-info-circle"></i>
                    </button>
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-primary upload-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#upload-modal">
                        <i class="ti ti-upload"></i>
                    </button>
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-warning edit-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#edit-modal">
                    <i class="ti ti-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-sm waves-effect waves-light btn-danger delete-btn" id="sa-confirm" data-id="'.$row->id.'">
                        <i class="ti ti-trash"></i>
                    </button>
                ';
                
            })
            ->rawColumns(['status_konsul', 'sharing_session', 'status_bayar', 'action'])
            ->make(true);
    }

    public function viewCustomer()
    {
        return view('bayarCustomer');
    }
    public function tableCustomer()
    {
        $pembayarans = Pembayaran::with(['customer', 'worker'])
        ->where('id_customer', $this->user->id)
        ->orderByDesc('id');

        return DataTables::of($pembayarans)
            ->addColumn('no', function ($row) {
                static $counter = 0;
                return ++$counter;
            })
            ->addColumn('nama_customer', function ($row) {
                return $row->customer->name;
            })
            ->addColumn('nama_worker', function ($row) {
                return $row->worker->name;
            })
            ->addColumn('status_konsul', function ($row) {
                $badge = $row->status_konsul == 'proses' ? 'warning' : 'primary';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->status_konsul . '</span>';
            })
            ->addColumn('sharing_session', function ($row) {
                $badge = $row->sharing_session == 'offline' ? 'info' : 'primary';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->sharing_session . '</span>';
            })
            ->addColumn('status_bayar', function ($row) {
                $badge = $row->status_bayar == 'paid' ? 'success' : 'danger';
                return '<span class="rounded-pill badge text-capitalize bg-' . $badge . '">' . $row->status_bayar . '</span>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-success info-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#info-modal">
                        <i class="ti ti-info-circle"></i>
                    </button>
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-primary upload-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#upload-modal">
                        <i class="ti ti-upload"></i>
                    </button>
                ';
                // <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-warning edit-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#edit-modal">
                //     <i class="ti ti-pencil"></i>
                // </button>
                // <button type="button" class="btn btn-sm waves-effect waves-light btn-danger delete-btn" id="sa-confirm" data-id="'.$row->id.'">
                //     <i class="ti ti-trash"></i>
                // </button>
            })
            ->rawColumns(['status_konsul', 'sharing_session', 'status_bayar', 'action'])
            ->make(true);
    }
    public function get($id)
    {
        $pembayaran = Pembayaran::with(['customer', 'worker'])
            ->where('id', $id)
            ->get();

        return response()->json($pembayaran);
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::find($id);
        return response()->json($pembayaran);
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'status_bayar' => 'required|in:paid,unpaid',
            'sharing_session' => 'required|in:online,offline',
            'status_konsul' => 'required|in:proses,sukses',
        ]);

        $pembayaran = Pembayaran::find($id);
        if (!$pembayaran) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        if ($validate['status_bayar'] == 'paid') {
            $check = SharingSession::with('pembayaran')->where('id_pembayaran', $pembayaran->id)->first();
            if (!$check) {
                $check = SharingSession::create([
                    'id_pembayaran' => $pembayaran->id,
                    'uuid' => Str::uuid(),
                    'expired_at' => Carbon::now()->addDays(1),
                ]);
            }
            
            $welcome_msg = "Hallo bagaimana kabar mu? Semoga sehat yaa...";
            
            if ($pembayaran->sharingSession == "online") {
                $welcome_msg = "Halo, selamat datang di sesi konsultasi online kami. Silakan ajukan pertanyaan atau diskusi langsung di sini. Kami siap membantu Anda secara virtual. Selamat berkonsultasi!";
            } else {
                $welcome_msg = "Halo, terima kasih telah hadir dalam sesi konsultasi offline kami. Jangan ragu untuk bertanya atau berdiskusi. Kami siap membantu dan memberikan solusi terbaik. Selamat berkonsultasi!";
            }

            Message::create([
                'id_penerima' => $pembayaran->id_customer,
                'id_pengirim' => $pembayaran->id_worker,
                'body' => $welcome_msg,
                'id_sharing' => $check->id,
            ]);
        }

        $pembayaran->status_bayar = $validate['status_bayar'];
        $pembayaran->sharing_session = $validate['sharing_session'];
        $pembayaran->status_konsul = $validate['status_konsul'];
        $pembayaran->save();

        return response()->json(['message' => 'Data has been updated'], 200);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        
        if ($pembayaran) {
            $pembayaran->delete();
            return response()->json(['message' => 'Data deleted successfully.']);
        } else {
            return response()->json(['message' => 'Data not found.'], 404);
        }
    }

    public function uploadBukti(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 422);
        }

        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        try {
            $file = $request->file('bukti_bayar');
            $path = $file->store('uploads/bukti_bayar', 'public');

            if ($pembayaran->bukti_bayar) {
                Storage::disk('public')->delete($pembayaran->bukti_bayar);
            }

            $pembayaran->bukti_bayar = $path;
            $pembayaran->save();

            return response()->json(['message' => 'File uploaded successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'File upload failed.', 'error' => $e->getMessage()], 500);
        }
    }
}
