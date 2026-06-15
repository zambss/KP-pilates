@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<div class="dashboard-header">
    <h1>Notifikasi</h1>
    <p>{{ $notifications->where('unread', true)->count() }} notifikasi belum dibaca</p>
</div>

<section class="section notification-section">

    <!-- FILTER -->
    <div class="notification-filter">
        <button class="filter-btn active">
            Semua <span>{{ $notifications->count() }}</span>
        </button>
        <button class="filter-btn">
            Belum Dibaca <span>{{ $notifications->where('unread', true)->count() }}</span>
        </button>
    </div>

    @forelse ($notifications as $notif)
        <div class="notification-item {{ $notif['unread'] ? 'unread' : '' }}">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>{{ $notif['title'] }}</h4>
                <p>{{ $notif['message'] }}</p>

                <div class="notif-action">
                    <span class="badge confirmed">Confirmed</span>
                </div>
            </div>

            <div class="notif-date">
                {{ optional($notif['date'])->format('d M Y') ?? '-' }}
            </div>
        </div>
    @empty
        <p class="text-center">Tidak ada notifikasi.</p>
    @endforelse

</section>

@endsection