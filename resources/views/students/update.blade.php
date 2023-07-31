@extends('layouts.master')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="inputName" class="col-form-label">Student Name</label>
        <input type="text" name="name" value="{{ old('name') ? old('name') : $student->user->name }}" class="form-control" id="inputName">
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4" class="col-form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') ? old('email') : $student->user->email }}" class="form-control" id="inputEmail4" readonly>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="form-group">
        <label for="inputAddress" class="col-form-label">Address</label>
        <input type="text" value="{{ old('address') ? old('address') : $student->address }}" class="form-control" name="address" id="inputAddress">
        @error('address')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputPhone" class="col-form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $student->phone }}" class="form-control" id="inputPhone">
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="inputGender" class="col-form-label">Gender</label>
            <select id="inputGender" name="gender" class="form-control">
                <option {{ $student->gender == '0' ? 'selected' : ''  }} value="0">Other</option>
                <option {{ $student->gender == '1' ? 'selected' : ''  }} value="1">Male</option>
                <option {{ $student->gender == '2' ? 'selected' : ''  }} value="2">Female</option>
            </select>
            @error('gender')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="inputDate" class="col-form-label">Birthday</label>
            <input type="date" name="birthday" value="{{ Carbon\Carbon::parse($student->birthday)->format('Y-m-d') }}" class="form-control" id="inputDate">
            @error('birthday')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputRole" class="col-form-label">Role</label>
            <select id="inputRole" name="is_admin" class="form-control">
                <option {{ $student->role == '1' ? 'selected' : ''  }} value="1">Student</option>
                <option {{ $student->role == '0' ? 'selected' : ''  }} value="0">Admin</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="example-fileinput">Choose Avatar</label>
        <input type="hidden" name="old_avatar" value="{{ isset($student->avatar) ? $student->avatar : '' }}">
        <input type="file" name="avatar" accept=".jpg, .png, .jpeg" id=" example-fileinput" class="form-control-file">
    </div>

    <button class="btn btn-primary" type="submit">Update Student</button>
</form>
@endsection