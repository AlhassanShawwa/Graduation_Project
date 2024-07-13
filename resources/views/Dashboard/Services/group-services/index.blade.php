@extends('Dashboard.layouts.master')
@section('title')
    {{__('main-sidebar_trans.Single_service')}}
@stop
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('main-sidebar_trans.Services')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('main-sidebar_trans.group_services')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Group Services</title>
        <!-- Include any necessary stylesheets or scripts -->
    </head>
    <body>
        <div>

            @if ($ServiceSaved)
                <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
            @endif

            <form action="{{ route('group-services.saveGroup') }}" method="POST" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="name_group">اسم المجموعة</label>
                    <input type="text" id="name_group" name="name_group" class="form-control" value="{{ old('name_group', $name_group) }}" required>
                </div>

                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea id="notes" name="notes" class="form-control" rows="5">{{ old('notes', $notes) }}</textarea>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-primary" onclick="addService()">اضافة خدمة فرعية</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th>اسم الخدمة</th>
                                        <th width="200">العدد</th>
                                        <th width="200">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($GroupsItems as $index => $groupItem)
                                        <tr>
                                            <td>
                                                @if ($groupItem['is_saved'])
                                                    {{ $groupItem['service_name'] }} ({{ number_format($groupItem['service_price'], 2) }})
                                                @else
                                                    <select name="GroupsItems[{{ $index }}][service_id]" class="form-control">
                                                        <option value="">-- اختر الخدمة --</option>
                                                        @foreach ($allServices as $service)
                                                            <option value="{{ $service->id }}" {{ $groupItem['service_id'] == $service->id ? 'selected' : '' }}>
                                                                {{ $service->name }} ({{ number_format($service->price, 2) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($groupItem['is_saved'])
                                                    {{ $groupItem['quantity'] }}
                                                @else
                                                    <input type="number" name="GroupsItems[{{ $index }}][quantity]" class="form-control" value="{{ $groupItem['quantity'] }}">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($groupItem['is_saved'])
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="editService({{ $index }})">تعديل</button>
                                                @elseif ($groupItem['service_id'])
                                                    <button type="button" class="btn btn-sm btn-success" onclick="saveService({{ $index }})">تأكيد</button>
                                                @endif
                                                <button type="button" class="btn btn-sm btn-danger" onclick="removeService({{ $index }})">حذف</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-4 ml-auto text-right">
                            <table class="table pull-right">
                                <tr>
                                    <td style="color: red">الاجمالي</td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: red">قيمة الخصم</td>
                                    <td><input type="number" name="discount_value" class="form-control w-75 d-inline" value="{{ $discount_value }}"></td>
                                </tr>
                                <tr>
                                    <td style="color: red">نسبة الضريبة</td>
                                    <td><input type="number" name="taxes" class="form-control w-75 d-inline" min="0" max="100" value="{{ $taxes }}"> %</td>
                                </tr>
                                <tr>
                                    <td style="color: red">الاجمالي مع الضريبة</td>
                                    <td>{{ number_format($total_with_tax, 2) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-outline-success">تأكيد البيانات</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Include any necessary scripts here -->
        <script>
            function addService() {
                // Implement your add service logic here
            }

            function editService(index) {
                // Implement your edit service logic here
            }

            function saveService(index) {
                // Implement your save service logic here
            }

            function removeService(index) {
                // Implement your remove service logic here
            }
        </script>
    </body>
    </html>


    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection



