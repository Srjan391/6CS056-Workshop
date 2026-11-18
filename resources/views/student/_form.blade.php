@csrf
<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required>
</div>
<div class="field">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
</div>
<div class="field">
    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone ?? '') }}" required>
</div>
<div class="field">
    <label for="address">Address</label>
    <textarea id="address" name="address" rows="3">{{ old('address', $student->address ?? '') }}</textarea>
</div>
<div class="field">
    <label for="date_of_birth">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', isset($student) ? $student->date_of_birth?->format('Y-m-d') : '') }}">
</div>
