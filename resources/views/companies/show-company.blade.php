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
                    <div class="add-company-btn" onclick="gotoAddCompany()" style="float: right">
                        <x-primary-button>{{ __('Add Company') }}</x-primary-button>
                    </div>

                    <div class="container" style="margin-top: 50px;">
                        <div class="info-div">
                            <h1>Company Info</h1>
                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>{{ $company->name }}</th>

                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>{{ $company->email }}</th>

                                    </tr>
                                    <tr>
                                        <th>website</th>
                                        <th><a href="{{ $company->website }}">{{ $company->name }}</a></th>

                                    </tr>
                                    <tr>
                                        <th>Logo</th>
                                        <th><img src="{{ asset('storage/company_logos/' . $company->logo) }}"
                                                alt="{{ $company->name }} Logo" style="height: 150px;width: 150px;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                     @if ($company)
                        <div class="container" style="margin-top: 50px;">
                            <h2 style="  padding: 10px; font-weight: 600; font-size: larger;">Employees list</h2>

                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company->employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-message" style="margin-top: 50px; text-align: center;">
                            {{ __("Company doesnt have a employee .") }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function gotoAddCompany() {
        window.location.href = '/companies/create'
    }
</script>
