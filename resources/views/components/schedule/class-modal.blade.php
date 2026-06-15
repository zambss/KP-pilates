<div class="class-modal" id="classModal">
    <div class="class-modal-overlay"></div>

    <div class="class-modal-box">
        <div class="class-modal-header">
            <div>
                <h3 id="modalClassTitle"></h3>
                <p id="modalClassTime"></p>
            </div>
            <button id="closeClassModal" class="modal-close">✕</button>
        </div>

        <div class="class-modal-content"></div>

        {{-- FORM BOOKING (SATU) --}}
        <form id="bookingForm" method="POST">
            @csrf
            {{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

        </form>
    </div>
</div>
