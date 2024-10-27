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
                    <button type="button" class="capitalize btn btn-sm waves-effect waves-light btn-primary info-btn" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#info-modal">
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
            'status_konsul' => 'required|in:pending,proses,sukses,batal',
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

    public function uploadBukti(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Maksimal 2MB
            'id_pembayaran' => 'required|integer|exists:pembayaran,id', // Validasi ID pembayaran
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan pembayaran yang ingin di-update
        $pembayaran = Pembayaran::find($request->id_pembayaran);

        if ($pembayaran) {
            // Upload file
            $file = $request->file('bukti_bayar');
            // Pastikan menggunakan store untuk menyimpan di folder public
            $path = $file->store('uploads/bukti_bayar', 'public'); // Menyimpan file di folder public/uploads/bukti_bayar
            
            // Hapus file lama jika ada
            if ($pembayaran->bukti_bayar) {
                Storage::disk('public')->delete($pembayaran->bukti_bayar);
            }

            // Update path bukti bayar di database
            $pembayaran->bukti_bayar = $path; // Update kolom bukti_bayar
            $pembayaran->save(); // Simpan perubahan

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Bukti bayar berhasil di-upload.');
        }

        // Jika pembayaran tidak ditemukan, kembalikan dengan error
        return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
    }


}
