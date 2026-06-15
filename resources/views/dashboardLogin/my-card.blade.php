@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<div class="dashboard-header">
    <h1>Card Saya</h1>
</div>

<!-- CARD SAYA -->
<div class="card-summary-grid">
@foreach ($memberships as $card)
    <div class="summary-card">
        <div class="summary-header">
            <strong>{{ $card->class->title }}</strong>

            <span class="status {{ $card->status }}">
                {{ ucfirst($card->status) }}
            </span>
        </div>

        <div class="summary-info">
            <p>Valid dari {{ $card->start_date->translatedFormat('d M Y') }}</p>
            <p>Valid hingga {{ $card->end_date->translatedFormat('d M Y') }}</p>
        </div>

        <div class="summary-footer">
            <span>Total kelas</span>
            <strong>{{ $card->total_sessions }}</strong>
        </div>
    </div>
@endforeach
</div>


<!-- CARD AKTIF -->
<div class="card-active-grid">
@foreach ($memberships as $card)
    <div class="active-card">
        <div class="active-header">
            <div>
                <strong>{{ $card->package_name }}</strong>
                <p>Valid hingga {{ $card->end_date->translatedFormat('d M Y') }}</p>
            </div>
            <span class="status {{ $card->status }}">
                {{ ucfirst($card->status) }}
            </span>
        </div>

        <div class="active-info">
            <div class="session-row">
                <span>Sesi tersisa</span>
                <strong>
                    {{ $card->remaining_sessions }}
                    / {{ $card->total_sessions }}
                </strong>
            </div>

            <div class="progress">
                <div class="progress-fill"
                     style="width:{{ $card->progress_percent }}%">
                </div>
            </div>

            <div class="session-footer">
                <span>{{ $card->used_sessions }} sesi digunakan</span>
                <span>{{ $card->remaining_sessions }} sesi tersisa</span>
            </div>
        </div>

        <a href="#" class="btn-primary">Booking Kelas</a>
    </div>
@endforeach
</div>


@endsection