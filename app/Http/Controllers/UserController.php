<?php


namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Attendance;

use App\Models\Coach;

use App\Models\Membership;

use App\Models\ClassOrder;
use App\Models\ClassPrice;
use App\Models\ClassSession;
use App\Models\ClassSchedule;

use App\Models\Packagee;
use App\Models\PackageItem;
use App\Models\PackageOrderr;
use App\Models\PaymentSetting;
use App\Models\UserProfile;

class UserController extends Controller
{
    /*
    |-----------------------------------
    | DASHBOARD
    |-----------------------------------
    */
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalClasses' => class_exists(ClassSession::class) ? ClassSession::count() : 0,
            'totalMembership' => class_exists(Membership::class) ? Membership::count() : 0,
        ]);
    }

    /*
    |-----------------------------------
    | USER CRUD
    |-----------------------------------
    */

    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }


    /* ==========================
   BOOKING SCHEDULE USER
========================== */
    public function bookingSchedule($id)
    {
        $user = Auth::user();

        $schedule = ClassSchedule::with('class')
            ->findOrFail($id);

        // ==========================
        // CEK CLASS CLOSED
        // ==========================
        if (!$schedule->is_open) {

            return back()->with(
                'error',
                'Kelas sedang ditutup'
            );
        }

        // ==========================
        // HITUNG QUOTA
        // ==========================
        $usedQuota = Booking::where(
            'class_schedule_id',
            $schedule->id
        )
            ->whereIn('status', [
                'booked',
                'attended'
            ])
            ->count();

        // ==========================
        // CEK FULL
        // ==========================
        if ($usedQuota >= $schedule->quota) {

            return back()->with(
                'error',
                'Kelas sudah penuh'
            );
        }

        // ==========================
        // CEK MEMBERSHIP
        // ==========================
        $membership = Membership::where(
            'user_id',
            $user->id
        )
            ->where(
                'class_id',
                $schedule->class_id
            )
            ->where(
                'status',
                'active'
            )
            ->first();

        if (!$membership) {

            return back()->with(
                'error',
                'Anda belum memiliki card untuk kelas ini'
            );
        }

        // ==========================
        // CEK SISA SESI
        // ==========================
        if ($membership->remaining_sessions <= 0) {

            return back()->with(
                'error',
                'Sisa sesi habis'
            );
        }

        // ==========================
        // CEK DOUBLE BOOKING
        // ==========================
        $alreadyBooked = Booking::where(
            'user_id',
            $user->id
        )
            ->where(
                'class_schedule_id',
                $schedule->id
            )
            ->whereIn('status', [
                'booked',
                'attended'
            ])
            ->exists();

        if ($alreadyBooked) {

            return back()->with(
                'error',
                'Anda sudah booking kelas ini'
            );
        }

        // ==========================
        // SIMPAN BOOKING
        // ==========================
        Booking::create([

            'user_id' => $user->id,

            'membership_id' => $membership->id,

            'class_schedule_id' => $schedule->id,

            'status' => 'booked'
        ]);

        // ==========================
        // POTONG SESI
        // ==========================
        $membership->increment('used_sessions');

        return back()->with(
            'success',
            'Booking kelas berhasil'
        );
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }



    // LIST
    public function userProfiles()
    {
        $profiles = UserProfile::with('user')->latest()->get();
        return view('admin.user-profiles.index', compact('profiles'));
    }

    // CREATE
    public function createUserProfile()
    {
        $users = \App\Models\User::all();
        return view('admin.user-profiles.create', compact('users'));
    }

    // STORE
    public function storeUserProfile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'phone' => 'nullable',
            'avatar' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $avatar = null;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
        }

        UserProfile::create([
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'health_note' => $request->health_note,
            'emergency_contact' => $request->emergency_contact,
            'status' => $request->status ?? 'active',
            'avatar' => $avatar
        ]);

        return redirect()->route('profiles.index')
            ->with('success', 'Profile berhasil dibuat');
    }

    // EDIT
    public function editUserProfile($id)
    {
        $profile = UserProfile::findOrFail($id);
        $users = \App\Models\User::all();

        return view('admin.user-profiles.edit', compact('profile', 'users'));
    }

    // UPDATE
    public function updateUserProfile(Request $request, $id)
    {
        $profile = UserProfile::findOrFail($id);

        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->route('profiles.index')
            ->with('success', 'Profile diupdate');
    }

    // DELETE
    public function deleteUserProfile($id)
    {
        $profile = UserProfile::findOrFail($id);

        if ($profile->avatar) {
            Storage::disk('public')->delete($profile->avatar);
        }

        $profile->delete();

        return back()->with('success', 'Profile dihapus');
    }

    // ======================
// CLASSES
// ======================

    public function classes()
    {
        $classes = \App\Models\ClassSession::latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function createClass()
    {
        return view('admin.classes.create');
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        \App\Models\ClassSession::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('classes.index')
            ->with('success', 'Class berhasil ditambahkan');
    }

    public function editClass($id)
    {
        $class = \App\Models\ClassSession::findOrFail($id);
        return view('admin.classes.edit', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        $class = \App\Models\ClassSession::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $class->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('classes.index')
            ->with('success', 'Class berhasil diupdate');
    }

    public function deleteClass($id)
    {
        \App\Models\ClassSession::findOrFail($id)->delete();

        return back()->with('success', 'Class berhasil dihapus');
    }

    // ======================
// MEMBERSHIP ADMIN
// ======================

    public function memberships()
    {
        $memberships = \App\Models\Membership::with('user', 'class')->latest()->get();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function createMembership()
    {
        $users = \App\Models\User::all();
        $classes = \App\Models\ClassSession::all();

        return view('admin.memberships.create', compact('users', 'classes'));
    }

    public function storeMembership(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'class_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_sessions' => 'required|numeric',
        ]);

        \App\Models\Membership::create([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_sessions' => $request->total_sessions,
            'used_sessions' => 0,
            'status' => 'active',
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership berhasil ditambahkan');
    }

    public function deleteMembership($id)
    {
        \App\Models\Membership::findOrFail($id)->delete();

        return back()->with('success', 'Membership berhasil dihapus');
    }

    // EDIT
    public function editMembership($id)
    {
        $membership = \App\Models\Membership::findOrFail($id);
        $users = \App\Models\User::all();
        $classes = \App\Models\ClassSession::all();

        return view('admin.memberships.edit', compact('membership', 'users', 'classes'));
    }

    // UPDATE
    public function updateMembership(Request $request, $id)
    {
        $membership = \App\Models\Membership::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'class_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_sessions' => 'required|numeric',
            'used_sessions' => 'required|numeric',
            'status' => 'required',
        ]);

        $membership->update([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_sessions' => $request->total_sessions,
            'used_sessions' => $request->used_sessions,
            'status' => $request->status,
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership berhasil diupdate');
    }



    // LIST


    public function bookings(Request $request)
    {
        $now = Carbon::now();

        $query = \App\Models\Booking::with('user', 'membership', 'schedule.class')

            // ❌ HILANGKAN yang attended
            ->where('status', '!=', 'attended')

            // ❌ HILANGKAN yang sudah lewat
            ->whereHas('schedule', function ($q) use ($now) {
                $q->where(function ($query) use ($now) {

                    // tanggal masih di masa depan
                    $query->whereDate('date', '>', $now->toDateString())

                        // ATAU hari ini tapi jam belum lewat
                        ->orWhere(function ($q2) use ($now) {
                        $q2->whereDate('date', $now->toDateString())
                            ->whereTime('end_time', '>=', $now->format('H:i:s'));
                    });

                });
            });

        // ========================
        // FILTER USER INPUT
        // ========================

        if ($request->class_id) {
            $query->whereHas('schedule.class', function ($q) use ($request) {
                $q->where('id', $request->class_id);
            });
        }

        if ($request->date) {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->whereDate('date', $request->date);
            });
        }

        if ($request->time) {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->where('start_time', '<=', $request->time)
                    ->where('end_time', '>=', $request->time);
            });
        }

        $bookings = $query->latest()->get();
        $classes = \App\Models\ClassSession::all();

        return view('admin.bookings.index', compact('bookings', 'classes'));
    }

    // CREATE
    public function createBooking()
    {
        $users = User::all();
        $memberships = Membership::all();
        $schedules = ClassSchedule::with('class')->get();

        return view('admin.bookings.create', compact('users', 'memberships', 'schedules'));
    }

    // STORE 🔥 (AUTO POTONG SESI)
    public function storeBooking(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'membership_id' => 'required',
            'class_schedule_id' => 'required',
        ]);

        // ==========================
        // GET DATA
        // ==========================
        $membership = Membership::findOrFail(
            $request->membership_id
        );

        $schedule = ClassSchedule::findOrFail(
            $request->class_schedule_id
        );

        // ==========================
        // CEK MEMBERSHIP HABIS
        // ==========================
        if (
            $membership->used_sessions >=
            $membership->total_sessions
        ) {
            return back()->with(
                'error',
                'Sesi membership sudah habis'
            );
        }

        // ==========================
        // CEK CLASS CLOSED
        // ==========================
        if (!$schedule->is_open) {

            return back()->with(
                'error',
                'Kelas sedang ditutup'
            );
        }

        // ==========================
        // HITUNG BOOKING
        // ==========================
        $usedQuota = Booking::where(
            'class_schedule_id',
            $schedule->id
        )
            ->where('status', 'booked')
            ->count();

        // ==========================
        // CEK FULL
        // ==========================
        if ($usedQuota >= $schedule->quota) {

            return back()->with(
                'error',
                'Kelas sudah penuh'
            );
        }

        // ==========================
        // CEK DOUBLE BOOKING
        // ==========================
        $alreadyBooked = Booking::where(
            'user_id',
            $request->user_id
        )
            ->where(
                'class_schedule_id',
                $schedule->id
            )
            ->where('status', 'booked')
            ->exists();

        if ($alreadyBooked) {

            return back()->with(
                'error',
                'Anda sudah booking kelas ini'
            );
        }

        // ==========================
        // SIMPAN BOOKING
        // ==========================
        Booking::create([

            'user_id' => $request->user_id,

            'membership_id' => $membership->id,

            'class_schedule_id' => $schedule->id,

            'status' => 'booked',
        ]);

        // ==========================
        // POTONG SESI
        // ==========================
        $membership->increment('used_sessions');

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking berhasil dibuat'
            );
    }


    

    public function updateScheduleRoom(Request $request, $id)
{
    $request->validate([
        'room' => 'required'
    ]);

    $schedule = ClassSchedule::findOrFail($id);

    /*
    |-----------------------------------
    | CEK BATAS 12 JAM
    |-----------------------------------
    */

    $classStart = Carbon::parse(
        $schedule->date . ' ' . $schedule->start_time
    );

    if (now()->gte($classStart->subHours(12))) {

        return response()->json([
            'success' => false,
            'message' => 'Studio tidak bisa diubah kurang dari 12 jam sebelum kelas'
        ]);
    }

    /*
    |-----------------------------------
    | UPDATE ROOM
    |-----------------------------------
    */

    $schedule->update([
        'room' => $request->room
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Studio berhasil diubah'
    ]);
}
    // LIST
    public function orders()
    {
        $orders = ClassOrder::with('user', 'class')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // CREATE
    public function createOrder()
    {
        $users = User::all();
        $classes = ClassSession::all();

        return view('admin.orders.create', compact('users', 'classes'));
    }

    // STORE
    public function storeOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'class_id' => 'required',
            'price' => 'required',
            'total_sessions' => 'required',
        ]);

        $order = ClassOrder::create([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'price' => $request->price,
            'total_sessions' => $request->total_sessions,
            'status' => 'paid'
        ]);

        // 🔥 AUTO BUAT MEMBERSHIP
        Membership::create([
            'user_id' => $order->user_id,
            'class_id' => $order->class_id,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_sessions' => $order->total_sessions,
            'used_sessions' => 0,
            'status' => 'active'
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil + membership dibuat');
    }

    public function approveOrder($id)
    {
        $order = ClassOrder::findOrFail($id);

        // update status jadi paid / approved
        $order->update([
            'status' => 'approved'
        ]);

        // 🔥 optional: kalau mau auto buat membership (kalau belum)
        Membership::create([
            'user_id' => $order->user_id,
            'class_id' => $order->class_id,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_sessions' => $order->total_sessions,
            'used_sessions' => 0,
            'status' => 'active'
        ]);

        return back()->with('success', 'Order berhasil di-approve');
    }

    public function rejectOrder($id)
    {
        $order = ClassOrder::findOrFail($id);

        $order->update([
            'status' => 'failed'
        ]);

        return back()->with('success', 'Order ditolak');
    }

    // LIST
    public function prices()
    {
        $prices = ClassPrice::with('class')->latest()->get();
        return view('admin.prices.index', compact('prices'));
    }

    // CREATE
    public function createPrice()
    {
        $classes = \App\Models\ClassSession::all();
        return view('admin.prices.create', compact('classes'));
    }

    // STORE
    public function storePrice(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'session_count' => 'required|numeric',
            'bonus_sessions' => 'nullable|numeric',
            'price' => 'required|numeric',
        ]);

        ClassPrice::create([
            'class_id' => $request->class_id,
            'session_count' => $request->session_count,
            'bonus_sessions' => $request->bonus_sessions ?? 0,
            'price' => $request->price,
        ]);

        return redirect()->route('prices.index')
            ->with('success', 'Harga berhasil ditambahkan');
    }

    // EDIT
    public function editPrice($id)
    {
        $price = ClassPrice::findOrFail($id);
        $classes = \App\Models\ClassSession::all();

        return view('admin.prices.edit', compact('price', 'classes'));
    }

    // UPDATE
    public function updatePrice(Request $request, $id)
    {
        $price = ClassPrice::findOrFail($id);

        $price->update($request->all());

        return redirect()->route('prices.index')
            ->with('success', 'Harga berhasil diupdate');
    }

    // DELETE
    public function deletePrice($id)
    {
        ClassPrice::findOrFail($id)->delete();

        return back()->with('success', 'Harga berhasil dihapus');
    }




    // LIST
    public function coaches()
    {
        $coaches = Coach::latest()->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    // CREATE
    public function createCoach()
    {
        return view('admin.coaches.create');
    }

    // STORE
    public function storeCoach(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('coaches', 'public');
        }

        Coach::create([
            'name' => $request->name,
            'photo' => $photoPath
        ]);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach berhasil ditambahkan');
    }

    // EDIT
    public function editCoach($id)
    {
        $coach = Coach::findOrFail($id);
        return view('admin.coaches.edit', compact('coach'));
    }

    // UPDATE
    public function updateCoach(Request $request, $id)
    {
        $coach = Coach::findOrFail($id);

        $data = ['name' => $request->name];

        if ($request->hasFile('photo')) {
            if ($coach->photo) {
                Storage::disk('public')->delete($coach->photo);
            }

            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $coach->update($data);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach berhasil diupdate');
    }

    // DELETE
    public function deleteCoach($id)
    {
        $coach = Coach::findOrFail($id);

        if ($coach->photo) {
            Storage::disk('public')->delete($coach->photo);
        }

        $coach->delete();

        return back()->with('success', 'Coach berhasil dihapus');
    }
    
/* ==========================
   ROOMS
========================== */

public function rooms()
{
    $rooms = Room::latest()->get();

    return view(
        'admin.studio.index',
        compact('rooms')
    );
}
public function createRoom()
{
    return view('admin.studio.create');
}
public function storeRoom(Request $request)
{
    $request->validate([

        'name' => 'required',

        'capacity' => 'required|numeric',
    ]);

    Room::create([

        'name' => $request->name,

        'capacity' => $request->capacity,

        'is_active' => $request->has('is_active'),
    ]);

    return redirect()
        ->route('studio.index')

        ->with(
            'success',
            'Ruangan berhasil ditambahkan'
        );
}
public function editRoom($id)
{
    $room = Room::findOrFail($id);

    return view(
        'admin.studio.edit',
        compact('room')
    );
}
public function updateRoom(
    Request $request,
    $id
) {

    $room = Room::findOrFail($id);

    $request->validate([

        'name' => 'required',

        'capacity' => 'required|numeric',
    ]);

    $room->update([

        'name' => $request->name,

        'capacity' => $request->capacity,

        'is_active' => $request->has('is_active'),
    ]);

    return redirect()
        ->route('studio.index')

        ->with(
            'success',
            'Ruangan berhasil diupdate'
        );
}
public function deleteRoom($id)
{
    $room = Room::findOrFail($id);

    $room->delete();

    return back()->with(
        'success',
        'Ruangan berhasil dihapus'
    );
}

    // LIST
    public function packageItems()
    {
        $items = PackageItem::with('package', 'class')->get();
        return view('admin.package-items.index', compact('items'));
    }

    // CREATE
    public function createPackageItem()
    {
        $packages = Packagee::all();
        $classes = ClassSession::all();

        return view('admin.package-items.create', compact('packages', 'classes'));
    }

    // STORE
    public function storePackageItem(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'class_id' => 'required',
            'session_count' => 'required|numeric',
        ]);

        PackageItem::create($request->all());

        return redirect()->route('package-items.index')
            ->with('success', 'Item paket berhasil ditambahkan');
    }

    // EDIT
    public function editPackageItem($id)
    {
        $item = PackageItem::findOrFail($id);
        $packages = Packagee::all();
        $classes = ClassSession::all();

        return view('admin.package-items.edit', compact('item', 'packages', 'classes'));
    }

    // UPDATE
    public function updatePackageItem(Request $request, $id)
    {
        $item = PackageItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('package-items.index')
            ->with('success', 'Item paket berhasil diupdate');
    }

    // DELETE
    public function deletePackageItem($id)
    {
        PackageItem::findOrFail($id)->delete();

        return back()->with('success', 'Item paket dihapus');
    }



    // LIST
    public function packageOrders()
    {
        $orders = PackageOrderr::with('user', 'package')->latest()->get();
        return view('admin.package-orders.index', compact('orders'));
    }

    // APPROVE (🔥 INTI LOGIC)
    public function approvePackageOrder($id)
    {
        $order = PackageOrderr::findOrFail($id);

        // ambil item dalam paket
        $items = PackageItem::where('package_id', $order->package_id)->get();

        foreach ($items as $item) {

            Membership::create([
                'user_id' => $order->user_id,
                'class_id' => $item->class_id,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'total_sessions' => $item->session_count,
                'used_sessions' => 0,
                'status' => 'active'
            ]);
        }

        $order->update(['status' => 'approved']);

        return back()->with('success', 'Order disetujui & membership dibuat');
    }

    // REJECT
    public function rejectPackageOrder($id)
    {
        $order = PackageOrderr::findOrFail($id);

        $order->update(['status' => 'rejected']);

        return back()->with('success', 'Order ditolak');
    }



    // LIST
    public function packages()
    {
        $packages = Packagee::latest()->get();
        return view('admin.packages.index', compact('packages'));
    }

    // CREATE
    public function createPackage()
    {
        return view('admin.packages.create');
    }

    // STORE
    public function storePackage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Packagee::create([
            'name' => $request->name,
            'price' => $request->price,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('packages.index')
            ->with('success', 'Paket berhasil dibuat');
    }

    // EDIT
    public function editPackage($id)
    {
        $package = Packagee::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    // UPDATE
    public function updatePackage(Request $request, $id)
    {
        $package = Packagee::findOrFail($id);

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('packages.index')
            ->with('success', 'Paket berhasil diupdate');
    }

    // DELETE
    public function deletePackage($id)
    {
        Packagee::findOrFail($id)->delete();

        return back()->with('success', 'Paket dihapus');
    }




    // ==========================
// LIST ATTENDANCE
// ==========================




    // ==========================
// HALAMAN ABSENSI
// ==========================
    public function attendances()
    {
        $bookings = Booking::with('user', 'classSchedule.class', 'classSchedule.coach')
            ->where('status', 'booked') // hanya yang belum hadir
            ->get();

        return view('admin.attendances.index', compact('bookings'));
    }

    // ==========================
// PROSES ABSEN
// ==========================
    public function doAttendance($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // ❌ sudah absen
        if (Attendance::where('booking_id', $bookingId)->exists()) {
            return back()->with('error', 'Sudah absen');
        }

        // ❌ kalau cancel
        if ($booking->status == 'cancelled') {
            return back()->with('error', 'Booking dibatalkan');
        }

        // ✅ buat attendance
        Attendance::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'class_schedule_id' => $booking->class_schedule_id,
            'attended_at' => now(),
        ]);

        // ✅ update status
        $booking->update(['status' => 'attended']);

        return back()->with('success', 'Absensi berhasil');
    }

public function schedule()
{
    $classes = ClassSession::all();

    $coaches = Coach::all();

    $rooms = Room::all();

    return view(
        'admin.schedule.index',
        compact(
            'classes',
            'coaches',
            'rooms'
        )
    );
}

    // ==========================
// USER SCHEDULE
// ==========================
    public function userSchedule()
    {
        $schedules = ClassSchedule::with('class', 'coach')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('user.schedule.index', compact('schedules'));
    }
    
// ==========================
// GET DATA (UNTUK JS)
// ==========================

/* ==========================
   GET SCHEDULES
========================== */
public function getSchedules(Request $request)
{
    $date = Carbon::parse($request->date);

    $startWeek = $date
        ->copy()
        ->startOfWeek(Carbon::SUNDAY);

    $endWeek = $date
        ->copy()
        ->endOfWeek(Carbon::SATURDAY);



    $data = ClassSchedule::with([
        'class',
        'coach'
    ])

    ->whereBetween('date', [
        $startWeek->toDateString(),
        $endWeek->toDateString()
    ])

    ->orderBy('date')

    ->orderBy('start_time')

    ->get()

    ->map(function ($item) {

        /*
        |--------------------------------------------------------------------------
        | AMBIL ROOM REALTIME
        |--------------------------------------------------------------------------
        */

        $room = Room::where(
            'name',
            $item->room
        )->first();



        /*
        |--------------------------------------------------------------------------
        | KAPASITAS REALTIME
        |--------------------------------------------------------------------------
        */

        $roomCapacity =
            $room?->capacity
            ?? $item->quota;



        /*
        |--------------------------------------------------------------------------
        | USED QUOTA
        |--------------------------------------------------------------------------
        */

        $usedQuota = Booking::where(
            'class_schedule_id',
            $item->id
        )
        ->whereIn('status', [
            'booked',
            'attended'
        ])
        ->count();



        return [

            'id' => $item->id,

            'title' => $item->class->title,

            'date' => $item->date,

            'start_time' => $item->start_time,

            'end_time' => $item->end_time,

            'coach' => $item->coach->name,



            /*
            |--------------------------------------------------------------------------
            | ROOM
            |--------------------------------------------------------------------------
            */

            'room' => $item->room,



            /*
            |--------------------------------------------------------------------------
            | QUOTA REALTIME
            |--------------------------------------------------------------------------
            */

            // compatibility lama
            'capacity' => $roomCapacity,

            // compatibility baru
            'quota' => $roomCapacity,



            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            */

            'used_quota' => $usedQuota,

            'remaining_quota' =>
                max(
                    0,
                    $roomCapacity - $usedQuota
                ),



            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'is_open' => $item->is_open,
        ];
    });

    return response()->json($data);
}



/* ==========================
   STORE SCHEDULE
========================== */
public function storeSchedule(Request $request)
{
    $request->validate([

        'class_id'   => 'required',

        'coach_id'   => 'required',

        'date'       => 'required',

        'start_time' => 'required',

        'room'       => 'required',
    ]);



    /*
    |--------------------------------------------------------------------------
    | AMBIL ROOM
    |--------------------------------------------------------------------------
    */

    $room = Room::where(
        'name',
        $request->room
    )->first();



    /*
    |--------------------------------------------------------------------------
    | FALLBACK QUOTA
    |--------------------------------------------------------------------------
    */

    $quota =
        $room?->capacity ?? 0;



    /*
    |--------------------------------------------------------------------------
    | DURATION
    |--------------------------------------------------------------------------
    */

    $duration =
        $request->duration ?? 60;



    /*
    |--------------------------------------------------------------------------
    | CREATE SCHEDULE
    |--------------------------------------------------------------------------
    */

    ClassSchedule::create([

        'class_id' => $request->class_id,

        'coach_id' => $request->coach_id,

        'date' => $request->date,

        'start_time' => $request->start_time,

        'end_time' => date(
            'H:i:s',
            strtotime(
                $request->start_time .
                " +{$duration} minutes"
            )
        ),

        /*
        |--------------------------------------------------------------------------
        | AUTO QUOTA FROM ROOM
        |--------------------------------------------------------------------------
        */

        'quota' => $quota,

        'room' => $request->room,

        'is_open' => true,
    ]);



    return response()->json([
        'success' => true
    ]);
}


// ==========================
// DELETE
// ==========================
    public function deleteSchedule($id)
    {
        ClassSchedule::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }

    // ==========================
// HOLD KELAS
// ==========================

    public function toggleSchedule($id)
    {
        $schedule = ClassSchedule::findOrFail($id);

        $schedule->update([

            'is_open' => !$schedule->is_open
        ]);

        return response()->json([

            'success' => true,

            'is_open' => $schedule->is_open
        ]);
    }


// ==========================
// GANTI NOREK
// ==========================

public function paymentSettings()
{
    $payment = PaymentSetting::first();

    return view(
        'admin.gantinorek.index',
        compact('payment')
    );
}
public function storePaymentSetting(Request $request)
{
    $request->validate([

        'bank_name' => 'required',

        'account_number' => 'required',

        'account_name' => 'required',
    ]);

    PaymentSetting::create([

        'bank_name' => $request->bank_name,

        'account_number' => $request->account_number,

        'account_name' => $request->account_name,

        'is_active' => true,
    ]);

    return back()->with(
        'success',
        'Rekening berhasil ditambahkan'
    );
}
public function updatePaymentSetting(
    Request $request,
    $id
) {

    $payment = PaymentSetting::findOrFail($id);

    $request->validate([

        'bank_name' => 'required',

        'account_number' => 'required',

        'account_name' => 'required',
    ]);

    $payment->update([

        'bank_name' => $request->bank_name,

        'account_number' => $request->account_number,

        'account_name' => $request->account_name,
    ]);

    return back()->with(
        'success',
        'Rekening berhasil diupdate'
    );
}

}