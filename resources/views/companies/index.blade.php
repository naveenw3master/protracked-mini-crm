@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

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
                
                    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Create Company</a>

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($companies) > 0)
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                @if($company->logo)
                                    <img src="{{ asset('storage/company-logos/'.$company->logo) }}" height="100" />
                                @endif
                                </td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    {{ Form::open(array('route' => ['companies.destroy', $company->id], 'method' => 'post')) }}
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you sure do you want to Delete?');" class="btn btn-danger btn-sm">Delete</button>   
                                    </form>                                 
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">No records found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $companies->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
