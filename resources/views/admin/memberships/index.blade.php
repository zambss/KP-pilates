@extends('layouts.admin')

@section('title', 'Membership')

@section('content')

<div class="membership-card">

    <!-- HEADER -->
    <div class="membership-header">
        <h4>Membership Management</h4>

        <a href="{{ route('memberships.create') }}" class="btn-add">
            + Tambah Membership
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="table-wrapper">

        <table class="membership-table">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Class</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($memberships as $m)

                @php
                $remaining = $m->total_sessions - $m->used_sessions;
                $progress = ($m->used_sessions / $m->total_sessions) * 100;
                @endphp

                <tr>

                    <!-- USER -->
                    <td>{{ $m->user->name }}</td>

                    <!-- CLASS -->
                    <td>
                        <span class="badge-soft">
                            {{ $m->class->title }}
                        </span>
                    </td>

                    <!-- PROGRESS -->
                    <td style="width:250px;">

                        <small>
                            {{ $m->used_sessions }}/{{ $m->total_sessions }} sesi
                        </small>

                        <div class="progress-bar-wrapper">
                            <div class="progress-bar-fill" style="width: {{ $progress }}%">
                            </div>
                        </div>

                        <small class="text-muted">
                            Sisa: {{ $remaining }}
                        </small>

                    </td>

                    <!-- STATUS -->
                    <td>
                        <span class="status-badge {{ $m->status }}">
                            {{ strtoupper($m->status) }}
                        </span>
                    </td>

                    <!-- ACTION -->
                    <td>

                        <a href="{{ route('memberships.edit', $m->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('memberships.delete', $m->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete" onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data membership
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection