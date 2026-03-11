@csrf

<div class="row">
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="customer_name">Nombre del cliente</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $reservation->customer_name ?? '') }}" maxlength="120" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="customer_phone">Telefono</label>
            <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $reservation->customer_phone ?? '') }}" maxlength="30" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="customer_email">Email</label>
            <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', $reservation->customer_email ?? '') }}" maxlength="120" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="reservation_date">Fecha y hora</label>
            <input type="datetime-local" id="reservation_date" name="reservation_date" value="{{ old('reservation_date', isset($reservation) ? $reservation->reservation_date->format('Y-m-d\TH:i') : '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="people_count">Cantidad de personas</label>
            <input type="number" id="people_count" name="people_count" min="1" max="20" value="{{ old('people_count', $reservation->people_count ?? 1) }}" required>
        </div>
    </div>
    <div class="col-md-8">
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
