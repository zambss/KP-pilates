@extends('layouts.dashboard')

@section('content')
<section class="pl-wrapper">

    {{-- HEADER --}}
    <div class="pl-header">
        <h1>Membership & Pricelist</h1>
        <p>Pilih paket membership atau sesi kelas yang tersedia</p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="pl-alert">
            {{ session('success') }}
        </div>
    @endif


    {{-- ======================
        PAKET PROMO
    ======================= --}}
    <div class="pl-section">

        <h2 class="pl-section-title">🔥 Paket Promo</h2>

        <div class="pl-membership-grid">

            @forelse($packages as $package)

                <div class="pl-member-card {{ $loop->first ? 'highlight' : '' }}">

                    @if($loop->first)
                        <span class="pl-badge">Best Value</span>
                    @endif

                    <h3>{{ $package->name }}</h3>

                    <div class="pl-price">
                        Rp {{ number_format($package->price,0,',','.') }}
                    </div>

                    <ul class="pl-feature">

                        @foreach($package->items as $item)
                            <li>
                                ✔ {{ $item->session_count }}
                                Session {{ $item->class->title }}
                            </li>
                        @endforeach

                    </ul>

                    <a href="{{ route('pricelist.package.checkout',$package) }}"
                       class="pl-btn">
                        Pilih Paket
                    </a>

                </div>

            @empty

                <p class="pl-empty">
                    Paket promo belum tersedia
                </p>

            @endforelse

        </div>

    </div>



    {{-- ======================
        GROUP CLASS
    ======================= --}}
    <div class="pl-section">

        <h2 class="pl-section-title">🏋️ Paket Sesi Group Class</h2>

        <div class="pl-class-grid">

            @foreach($classes as $class)

                <div class="pl-class-card">

                    <div class="pl-class-header">
                        <h4>{{ $class->title }}</h4>
                        <span class="pl-category">
                            {{ ucfirst($class->category) }}
                        </span>
                    </div>

                    <div class="pl-session-list">

                        @foreach($class->prices as $price)

                            <a href="{{ route('pricelist.checkout',$price) }}"
                               class="pl-session">

                                <span>
                                    {{ $price->session_count }} Session
                                </span>

                                <strong>
                                    Rp {{ number_format($price->price,0,',','.') }}
                                </strong>

                            </a>

                        @endforeach

                        @if($class->prices->isEmpty())

                            <p class="pl-empty">
                                Belum ada harga
                            </p>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>
@endsection