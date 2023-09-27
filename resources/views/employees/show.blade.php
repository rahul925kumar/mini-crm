<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Info') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('message') && now() < session('expires_at'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="add-company-btn" onclick="gotoAddEmployee()" style="float: right">
                        <x-primary-button>{{ __('Add Employees') }}</x-primary-button>
                    </div>

                    <div class="container" style="margin-top: 50px;">
                        <div class="info-div">
                            <h1>Employee Info</h1>
                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>{{ $employee->first_name }} {{$employee->last_name}}</th>

                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>{{ $employee->email }}</th>

                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>{{ $employee->phone }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container" style="margin-top: 50px;">
                        <div class="info-div">
                            <h1>Company Info</h1>
                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>{{ $employee->company->name }}</th>

                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>{{ $employee->company->email }}</th>

                                    </tr>
                                    <tr>
                                        <th>website</th>
                                        <th><a href="{{ $employee->company->website }}">{{ $employee->company->name }}</a></th>

                                    </tr>
                                    <tr>
                                        <th>Logo</th>
                                        <th><img src="{{ asset('storage/company_logos/' . $employee->company->logo) }}"
                                                alt="{{ $employee->company->name }} Logo" style="height: 150px;width: 150px;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function gotoAddEmployee() {
        window.location.href = '/employee/create'
    }
</script>
