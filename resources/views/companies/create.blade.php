@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Company') }}</div>

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
                
                    <!-- form start -->
                    {{ Form::open(array('route' => ['companies.store'], 'method' => 'post', 'files' => true)) }}
                        @csrf
                        <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input name="website" type="text" class="form-control" id="website" placeholder="Website" value="{{ old('website') }}">
                                    @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Logo</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input name="logo" type="file" class="custom-file-input" id="image" accept="image/*">
                                    </div>
                                    </div>
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
