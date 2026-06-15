@extends('layouts.admin')

@section('title', 'Edit Package Item')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Package Item</h4>

        <form method="POST" action="{{ route('package-items.update', $item->id) }}">
            @csrf
            @method('PUT')

            <!-- SESSION -->
            <input type="number" name="session_count" value="{{ $item->session_count }}" class="form-input"
                placeholder="Jumlah sesi">

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('package-items.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection