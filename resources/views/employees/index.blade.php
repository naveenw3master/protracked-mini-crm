@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                        {{ session()->get('success') }}  
                        </div>
                    @endif
                
                    @if(session()->get('error'))
                        <div class="alert alert-danger">
                        {{ session()->get('error') }}  
                        </div>
                    @endif
                
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create Employee</a>

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($employees) > 0)
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    {{ Form::open(array('route' => ['employees.destroy', $employee->id], 'method' => 'post')) }}
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you sure do you want to Delete?');" class="btn btn-danger btn-sm">Delete</button>   
                                    </form>                                 
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No records found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $employees->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
