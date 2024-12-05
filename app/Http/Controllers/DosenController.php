<?php
// DosenController.php
namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\KegiatanModel; 
use Illuminate\Http\Request;

class DosenController extends Controller
{
   public function index()
   {
       $user = auth()->user();
       
       $kegiatanJTI = KegiatanModel::with(['user', 'kategori'])
           ->where('kategori_kegiatan_id', 1) 
           ->where(function($q) use ($user) {
               $q->where('user_id', $user->user_id)
                 ->orWhereHas('anggota', function($q) use ($user) {
                     $q->where('user_id', $user->user_id);
                 });
           })->get();

       $kegiatanNonJTI = KegiatanModel::with(['user', 'kategori'])
           ->where('kategori_kegiatan_id', 2)  
           ->where(function($q) use ($user) {
               $q->where('user_id', $user->user_id)
                 ->orWhereHas('anggota', function($q) use ($user) {
                     $q->where('user_id', $user->user_id);
                 });
           })->get();

       return view('dosen.dashboard', compact('kegiatanJTI', 'kegiatanNonJTI'));
   }

   public function detailKegiatan($id)
   {
       $user = auth()->user();
       $kegiatan = KegiatanModel::with(['user', 'anggota', 'agenda'])->find($id);
       
       $isPIC = $kegiatan->user_id == $user->user_id;
       $isAnggota = $kegiatan->anggota()->where('user_id', $user->user_id)->exists();

       if (!$isPIC && !$isAnggota) {
           abort(403);
       }

       return view('dosen.detail_kegiatan', compact('kegiatan', 'isPIC'));
   }
}