@extends('layouts.admin')

@section('content')

{{-- =========================
   PAGE HEADER
========================= --}}
<div class="page-header studio-page-header">

    <div>

        <h2>
            Data Studio
        </h2>

        <p>
            Kelola studio, kapasitas, dan status studio kelas
        </p>

    </div>

</div>



{{-- =========================
   FORM TAMBAH STUDIO
========================= --}}
<div class="card-box studio-card mb-4">

    <div class="studio-card-header">

        <h3>
            Tambah Studio
        </h3>

    </div>



    <form action="{{ route('studio.store') }}" method="POST">

        @csrf


        <div class="studio-form-grid">

            {{-- =========================
               NAMA STUDIO
            ========================== --}}
            <div class="studio-form-group">

                <label>
                    Nama Studio
                </label>

                <input type="text" name="name" class="studio-input" placeholder="Contoh: Studio A" required>

            </div>



            {{-- =========================
               KAPASITAS
            ========================== --}}
            <div class="studio-form-group">

                <label>
                    Kapasitas
                </label>

                <input type="number" name="capacity" class="studio-input" placeholder="Contoh: 15" required>

            </div>



            {{-- =========================
               STATUS
            ========================== --}}
            <div class="studio-form-group">

                <label>
                    Status
                </label>

                <select name="is_active" class="studio-select">

                    <option value="1">

                        Aktif

                    </option>

                    <option value="0">

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>



        {{-- =========================
           ACTION
        ========================== --}}
        <div class="studio-form-action">

            <button type="submit" class="btn-primary-custom studio-submit-btn">

                Tambah Studio

            </button>

        </div>

    </form>

</div>



{{-- =========================
   TABLE STUDIO
========================= --}}
<div class="card-box studio-card">

    <div class="studio-card-header">

        <h3>
            List Studio
        </h3>

    </div>



    <div class="studio-table-wrapper">

        <table class="studio-table">

            <thead>

                <tr>

                    <th width="70">
                        No
                    </th>

                    <th>
                        Nama Studio
                    </th>

                    <th width="140">
                        Kapasitas
                    </th>

                    <th width="140">
                        Status
                    </th>

                    <th width="220">
                        Aksi
                    </th>

                </tr>

            </thead>



            <tbody>

                @forelse($rooms as $room)

                <tr>

                    {{-- NO --}}
                    <td>

                        {{ $loop->iteration }}

                    </td>



                    {{-- NAMA --}}
                    <td class="studio-name">

                        {{ $room->name }}

                    </td>



                    {{-- KAPASITAS --}}
                    <td>

                        {{ $room->capacity }} Orang

                    </td>



                    {{-- STATUS --}}
                    <td>

                        @if($room->is_active)

                        <span class="studio-badge active">

                            Aktif

                        </span>

                        @else

                        <span class="studio-badge inactive">

                            Nonaktif

                        </span>

                        @endif

                    </td>



                    {{-- ACTION --}}
                    <td>

                        <div class="studio-action-group">

                            {{-- EDIT --}}
                            <a href="{{ route('studio.edit', $room->id) }}" class="btn-primary-custom btn-sm">

                                Edit

                            </a>



                            {{-- DELETE --}}
                            <form action="{{ route('studio.delete', $room->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-danger-custom btn-sm"
                                    onclick="return confirm('Hapus studio ini?')">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="studio-empty">

                        Belum ada studio

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection