@extends('Dashboard.layouts.master')
@section('css')


@endsection

@section('title')
    {{$section->name}} / {{__('sections_trans.section_doctors')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{$section->name}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('sections_trans.section_doctors')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('doctors.name')}}</th>
                                <th>{{__('doctors.email')}}</th>
                                <th>{{__('doctors.section')}}</th>
                                <th>{{__('doctors.phone')}}</th>
                                <th>{{__('doctors.appointments')}}</th>
                                <th>{{__('doctors.Status')}}</th>
                                <th>{{__('doctors.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$doctor->name}}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->section->name}}</td>
                                <td>{{ $doctor->phone}}</td>
                                <td>
                                    @foreach($doctor->doctorappointments as $appointment)
                                        {{$appointment->name}}
                                    @endforeach
                                </td>
                                <td>
                                    <div
                                        class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
                                    {{$doctor->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled')}}
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('doctors.Processes')}}<i class="fas fa-caret-down mr-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href="{{route('Doctors.edit',$doctor->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password{{$doctor->id}}"><i   class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status{{$doctor->id}}"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp;تغير الحالة</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$doctor->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف البيانات</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('Dashboard.Doctors.delete')
                            @include('Dashboard.Doctors.delete_select')
                            @include('Dashboard.Doctors.update_password')
                            @include('Dashboard.Doctors.update_status')
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
