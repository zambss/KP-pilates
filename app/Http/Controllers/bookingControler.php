<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    //
public function form(ClassSchedule $class)
{
    return view('booking.form', [
        'class' => $class,
        'user'  => auth()->user(),
    ]);
}
public function confirm(Request $request)
{
    // validasi data diri
    $data = $request->validate([
        'class_id' => 'required',
        'name'     => 'required',
        'email'    => 'required|email',
        'phone'    => 'required',
    ]);

    // simpan sementara ke session
    session(['booking_data' => $data]);

    return response()->json([
        'status' => 'ok'
    ]);
}
public function store()
{
    $data = session('booking_data');

    if (!$data) {
        abort(403);
    }

    $transaction = Transaction::create([
        'user_id'    => auth()->id(),
        'class_id'   => $data['class_id'],
        'amount'     => ClassSchedule::find($data['class_id'])->price,
        'status'     => 'pending',
        'expired_at' => now()->addHour(),
    ]);
    Transaction::where('status', 'pending')
    ->where('expired_at', '<', now())
    ->update(['status' => 'expired']);

    session()->forget('booking_data');

    return redirect()->route('booking.receipt', $transaction);
    
}
public function receipt(Transaction $transaction)
{
    // validasi kepemilikan
    if ($transaction->user_id !== auth()->id()) {
        abort(403);
    }

    return view('booking.receipt', compact('transaction'));
    
}
public function form(Request $request)
    {
        // ambil data dari query string
        $paket = $request->query('paket');
        $sesi  = $request->query('sesi');
        $harga = $request->query('harga');

        return view('booking.form', compact('paket', 'sesi', 'harga'));
    }


}