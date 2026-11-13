@csrf

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="customer_name">Nombre del cliente</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $reservation->customer_name ?? '') }}" maxlength="120" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="customer_phone">Telefono</label>
            <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $reservation->customer_phone ?? '') }}" maxlength="30" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="customer_email">Email</label>
            <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', $reservation->customer_email ?? '') }}" maxlength="120" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="check_in">Check-in</label>
            <input type="date" id="check_in" name="check_in" value="{{ old('check_in', isset($reservation) && $reservation->check_in ? $reservation->check_in->format('Y-m-d') : '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="check_out">Check-out</label>
            <input type="date" id="check_out" name="check_out" value="{{ old('check_out', isset($reservation) && $reservation->check_out ? $reservation->check_out->format('Y-m-d') : '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="product_id">Habitación física</label>
            @if(isset($reservation) && ! $reservation->product_id)
                <div class="alert alert-warning">Reserva anterior sin habitación vinculada ({{ $reservation->room_type ?? 'sin identificar' }}). Seleccioná la unidad correcta antes de confirmarla, o cancelá la solicitud.</div>
            @endif
            <select id="product_id" name="product_id" class="form-select">
                <option value="">Seleccionar habitación</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" @selected((string) old('product_id', $reservation->product_id ?? '') === (string) $room->id)>
                        #{{ $room->id }} · {{ $room->name }} · {{ $room->stock }} personas{{ ! $room->is_active ? ' (inactiva)' : '' }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Cada registro representa una unidad. La salida libera la habitación para otra entrada ese día.</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="adults">Adultos</label>
            <input type="number" id="adults" name="adults" min="1" max="8" value="{{ old('adults', $reservation->adults ?? 1) }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="children">Ninos</label>
            <input type="number" id="children" name="children" min="0" max="6" value="{{ old('children', $reservation->children ?? 0) }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="select-style-1">
            <label for="status">Estado</label>
            <div class="select-position">
                <select id="status" name="status" required>
                    @php $selectedStatus = old('status', $reservation->status ?? 'pendiente'); @endphp
                    <option value="pendiente" @selected($selectedStatus === 'pendiente')>Pendiente</option>
                    <option value="confirmada" @selected($selectedStatus === 'confirmada')>Confirmada</option>
                    <option value="cancelada" @selected($selectedStatus === 'cancelada')>Cancelada</option>
                    <option value="completada" @selected($selectedStatus === 'completada')>Completada</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="input-style-1">
            <label for="notes">Notas</label>
            <textarea id="notes" name="notes" rows="4" maxlength="1000">{{ old('notes', $reservation->notes ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-3">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.reservas.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
