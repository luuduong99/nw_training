@extends('layouts.master')
@section('title', 'Subjects')
@section('subTitle', 'List')
@section('content')
    <div style="width: 100%; display: flex;justify-content: space-between">
        <div class="col-sm-4" style="padding: 0">
            <a href="{{ route('edu.subjects.create') }}" class="btn btn-success mb-2"><i
                    class="mdi mdi-plus-circle mr-2"></i>
                {{ __('Add Subject') }}
            </a>
        </div>
    </div>
    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            @if (Auth::user()->role->role == 'student')
                <th></th>
            @endif
            <th>{{ __('Name') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Faculty') }}</th>
            <th>{{ __('Created_at') }}</th>
            <th>{{ __('Updated_at') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        {!! Form::open(['route' => 'edu.students.register-multiple-subject',
        'method' => 'post', 'id' => 'multiple_submit']) !!}
        {!! Form::token() !!}
        @if (Auth::user()->role->role == 'student')
            {!! Form::submit(__('Register Multiple Subject'),
            ['class' => 'btn btn-primary', 'style' => 'float: right']) !!}
        @endif
        @foreach ($subjects as $subject)
            <tr>
                @if (Auth::user()->role->role == 'student')
                    <td>
                        {!! Form::checkbox('subject_id[]', $subject->id,
                        in_array($subject->id, $results), ['disabled' => in_array($subject->id, $results)]) !!}
                    </td>
                @endif
                <td><a href="">{{ __($subject->name) }}</a></td>
                <td>{{ __($subject->description) }}</td>
                <td>{{ __($subject->faculty->name) }}</td>
                <td>{{ $subject->created_at }}</td>
                <td>{{ $subject->updated_at }}</td>
                <td class="table-action">
                    @if (Auth::user()->role->role == 'admin')
                        <a href="{{ route('edu.subjects.edit', $subject->id) }}" class="btn btn-primary">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        @if (!in_array($subject->id, $array))
                            <button value="{{ $subject->id }}" class="btn btn-danger delete-link">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        @else
                            <span class="btn btn-danger"
                                  onclick="return window.alert('It is not possible ' +
                                   'to delete a subject that has already been registered');">
                            <i class="mdi mdi-delete"></i>
                        </span>
                        @endif
                    @else
                        @if (in_array($subject->id, $results))
                            <span>{{ __('Đã Đăng Kí') }}</span>
                        @else
                            <span>{{ __('Chưa Đăng Kí') }}</span>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        {!! Form::close() !!}

        </tbody>
    </table>
    <div style="padding-top: 10px;">
        {{ $subjects->links() }}
    </div>

    {!! Form::open(['route' => ['edu.subjects.destroy', $subject->id], 'method' => 'delete', 'id' => 'delete-form']) !!}
    {!! Form::close() !!}

    @push('scripts')
        <script>
            $(document).ready(function () {
                $(".delete-link").click(function (e) {
                    e.preventDefault();

                    var subjectId = $(this).val();
                    var newAction = "{{ route('edu.subjects.destroy', ':id') }}";
                    var action = newAction.replace(':id', subjectId);
                    $("#delete-form").attr("action", action);
                    var confirmDelete = confirm('Are you sure?');

                    if (confirmDelete) {
                        $("#delete-form").submit();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                var successSubject = "{{ Session::has('add_subject') }}";
                var updateSubject = "{{ Session::has('update_subject') }}";
                var deleteSubject = "{{ Session::has('delete_subject') }}";
                var deleteFalse = "{{ Session::has('delete_false') }}";

                if (successSubject) {
                    $.toast({
                        heading: '{{ __('Add subject') }}',
                        text: '<h6>{{ __(Session::get("add_subject")) }}</h6>',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    })
                }

                if (updateSubject) {
                    $.toast({
                        heading: '{{ __('Update subject') }}',
                        text: '<h6>{{ __(Session::get("update_subject")) }}</h6>',
                        showHideTransition: 'slide',
                        icon: 'info',
                        position: 'top-right',
                    })
                }

                if (deleteSubject) {
                    $.toast({
                        heading: '{{ __('Delete subject') }}',
                        text: '<h6>{{ __(Session::get("delete_subject")) }}</h6>',
                        showHideTransition: 'slide',
                        icon: 'error',
                        position: 'top-right',
                    })
                }

                if (deleteFalse) {
                    $.toast({
                        heading: '{{ __('Delete subject false') }}',
                        text: '<h6>{{ __(Session::get("delete_false")) }}</h6>',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        position: 'top-right',
                    })
                }
            });
        </script>
    @endpush
@endsection
