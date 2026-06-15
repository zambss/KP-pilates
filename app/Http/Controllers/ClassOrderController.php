<?php

namespace App\Http\Controllers;

use App\Models\ClassOrder;
use App\Models\ClassSession;
use App\Models\ClassPrice;
use App\Models\Package;
use App\Models\Packagee;
use App\Models\PackageOrderr;
use App\Models\PaymentSetting;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClassOrderController extends Controller
{

    /**
     * FORM CHECKOUT
     */

    public function checkout(Request $request, ClassSession $class)
{
    $request->validate([
        'price_id' => 'required|exists:class_prices,id',
    ]);

    $user = Auth::user();

    $price = ClassPrice::findOrFail(
        $request->price_id
    );

    $profile = UserProfile::firstOrCreate([
        'user_id' => $user->id
    ]);

    $payment = PaymentSetting::where(
        'is_active',
        true
    )->first();

    return view(
        'checkout.form',
        compact(
            'class',
            'price',
            'user',
            'profile',
            'payment'
        )
    );
}


    /**
     * SIMPAN PEMBELIAN
     */
    public function store(Request $request, ClassSession $class)
    {
       
 Log::info('MASUK STORE METHOD');
        $user  = Auth::user();
        $price = ClassPrice::findOrFail($request->price_id);

        $session = $price->session_count;
        $bonus   = $price->bonus_sessions;
        $totalSessions = $session + $bonus;
 Log::info('LOLOS VALIDATION');
        // update profile
       
Log::info('LOLOS VALIDATIONmmm');
        // create order
        $order = ClassOrder::create([
            'user_id'        => $user->id,
            'class_id'       => $class->id,
            'class_price_id' => $price->id,
            'total_sessions' => $totalSessions,
            'price'          => $price->price,
            'status'         => 'pending',

        ]);

        // WA admin
        $waText = urlencode(
            "Halo admin Rens.Pilates 👋\n\n".
            "Order baru menunggu ACC\n\n".
            "Nama: {$user->name}\n".
            "Kelas: {$class->title}\n".
            "Sesi: {$session} + Bonus {$bonus}\n".
            "Total Sesi: {$totalSessions}\n".
            "Harga: Rp".number_format($price->price,0,',','.')."\n".
            "Order ID: {$order->id}"
        );

        return redirect("https://wa.me/6281260939460?text={$waText}");
    }



    /**
     * HALAMAN PRICELIST
     */
    public function index()
    {
        return view('dashboardLogin.pricelist', [
            'classes'  => ClassSession::with('prices')->get(),
            'packages' => Packagee::with('items.class')
                ->where('is_active', true)
                ->get(),
        ]);
    }



    /**
     * ==========================
     * BELI HARGA SATUAN
     * ==========================
     */
public function checkoutFromPricelist(ClassPrice $classPrice)
{
    $user = Auth::user();

    $profile = UserProfile::firstOrCreate([
        'user_id' => $user->id,
    ]);

    $payment = PaymentSetting::where(
        'is_active',
        true
    )->first();

    return view('checkout.form', [

        'class'   => $classPrice->class,

        'price'   => $classPrice,

        'user'    => $user,

        'profile' => $profile,

        'payment' => $payment,
    ]);
}


    public function storeFromPricelist(Request $request, ClassPrice $classPrice)
    {
        $request->validate([
            'phone'             => 'required',
            'address'           => 'required',
            'emergency_contact' => 'required',
        ]);

      $user = Auth::user();

        $session = $classPrice->session_count;
        $bonus   = $classPrice->bonus_sessions;
        $totalSessions = $session + $bonus;

        // update profile
        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone'             => $request->phone,
                'address'           => $request->address,
                'emergency_contact' => $request->emergency_contact,
            ]
        );

        // create order
        $order = ClassOrder::create([
            'user_id'        => $user->id,
            'class_id'       => $classPrice->class_id,
            'class_price_id' => $classPrice->id,
            'total_sessions' => $totalSessions,
            'price'          => $classPrice->price,
            'status'         => 'pending',
        ]);

        // WA admin
        $waText = urlencode(
            "Halo admin Rens.Pilates 👋\n\n".
            "Order baru menunggu ACC\n\n".
            "Nama: {$user->name}\n".
            "Kelas: {$classPrice->class->title}\n".
            "Sesi: {$session} + Bonus {$bonus}\n".
            "Total Sesi: {$totalSessions}\n".
            "Harga: Rp".number_format($classPrice->price,0,',','.')."\n".
            "Order ID: {$order->id}"
        );

        return redirect("https://wa.me/6281260939460?text={$waText}");
    }



    /**
     * ==========================
     * BELI PAKET PROMO
     * ==========================
     */
public function buyPackage(Request $request, Packagee $package)
{

    $request->validate([
        'phone'             => 'required',
        'address'           => 'required',
        'emergency_contact' => 'required',
        'agreement' => 'required',

        // upload bukti transfer
        'payment_proof'     => 'required|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    $user = Auth::user();


    // =========================
    // UPDATE PROFILE
    // =========================
    UserProfile::updateOrCreate(
        ['user_id' => $user->id],
        [
            'phone'             => $request->phone,
            'address'           => $request->address,
            'emergency_contact' => $request->emergency_contact,
        ]
    );


    // =========================
    // UPLOAD BUKTI TRANSFER
    // =========================
    $paymentProof = null;

    if ($request->hasFile('payment_proof')) {

        $paymentProof = $request
            ->file('payment_proof')
            ->store('payment-proofs', 'public');
    }


    // =========================
    // CREATE ORDER
    // =========================
    $order = PackageOrderr::create([
        'user_id'        => $user->id,
        'package_id'     => $package->id,
        'price'          => $package->price,
        'status'         => 'pending',

        // NEW
        'payment_proof'  => $paymentProof,
    ]);


    // =========================
    // REDIRECT
    // =========================
    return redirect()
        ->route('dashboardLogin.transaksi')
        ->with('success', 'Pesanan berhasil dikirim dan menunggu verifikasi admin.');
}


public function checkoutPackage(Packagee $package)
{
    $user = Auth::user();

    $profile = UserProfile::firstOrCreate([
        'user_id' => $user->id,
    ]);

    // =========================
    // PAYMENT SETTINGS
    // =========================
    $payment = PaymentSetting::where(
        'is_active',
        true
    )->first();

    return view(
        'checkout.formPackage',
        compact(
            'package',
            'user',
            'profile',
            'payment'
        )
    );
}

}