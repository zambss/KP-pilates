@extends('layouts.admin')

@section('content')

<div class="room-edit-page">

    {{-- =========================
       TITLE
    ========================== --}}
    <h2 class="room-edit-title">

        Edit Ruangan

    </h2>



    {{-- =========================
       FORM CARD
    ========================== --}}
    <div class="room-edit-card">

        <form action="{{ route('studio.update', $room->id) }}" method="POST">

            @csrf
            @method('PUT')


            {{-- =========================
               NAMA RUANGAN
            ========================== --}}
            <div class="room-edit-group">

                <label>

                    Nama Ruangan

                </label>

                <input type="text" name="name" value="{{ $room->name }}" class="room-edit-input" required>

            </div>



            {{-- =========================
               KAPASITAS
            ========================== --}}
            <div class="room-edit-group">

                <label>

                    Kapasitas

                </label>

                <input type="number" name="capacity" value="{{ $room->capacity }}" class="room-edit-input" required>

            </div>



            {{-- =========================
               STATUS
            ========================== --}}
            <div class="room-edit-group">

                <div class="room-edit-checkbox">

                    <input type="checkbox" name="is_active" id="is_active" {{ $room->is_active ? 'checked' : '' }}>

                    <label for="is_active">

                        Aktif

                    </label>

                </div>

            </div>



            {{-- =========================
               BUTTON
            ========================== --}}
            <button type="submit" class="btn-primary-custom room-edit-btn">

                Update Ruangan

            </button>

        </form>

    </div>

</div>

@endsection