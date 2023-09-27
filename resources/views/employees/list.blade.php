<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees List') }}
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
                                        @if(session('success'))
                        @if(now() < session('expires_at'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    @endif
                    <div class="add-company-btn" onclick="gotoAddEmployee()" style="float: right">
                        <x-primary-button>{{ __('Add Employees') }}</x-primary-button>
                    </div>
                    @if (count($employees) > 0)
                        <div class="container" style="margin-top: 50px;">
                            <h2 style="    padding: 10px; font-weight: 600; font-size: larger;">Employees list</h2>

                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}
                                            </td>
                                            <td>{{ $employee->company->name }} </td>
                                            <td>
                                                <a href="{{url('/employee/'.$employee->id)}}"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{url('/employee/'.$employee->id.'/edit')}}"><i class="fa-solid fa-pencil"></i></i></a>
                                                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <div class="pagination">
                                        {{ $employees->links() }}
                                    </div>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="empty-message" style="margin-top: 50px; text-align: center;">
                            {{ __("Employe's Table is empty") }}
                        </div>
                    @endif

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
