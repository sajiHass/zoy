@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.users'))}}
@endsection
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h3>{{ucwords(__('cp.users'))}}</h3>
                </div>
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div>
                <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                    <button type="button" class="btn btn-secondary" href="#activation" role="button" data-toggle="modal">
                        <i class="icon-xl la la-check"></i>
                        <span>{{__('cp.active')}}</span>
                    </button>
                    <button type="button" class="btn btn-secondary" href="#cancel_activation" role="button" data-toggle="modal">
                        <i class="icon-xl la la-ban"></i>
                        <span>{{__('cp.not_active')}}</span>
                    </button>
                    <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">
                        <i class="flaticon-delete"></i>
                        <span>{{__('cp.delete')}}</span>
                    </button>
                </div>
                <a href="{{url(getLocal().'/admin/exportUsers?')}}@foreach(request()->query() as $key => $one){{$key}}={{$one}}&@endforeach"
                   class="btn btn-secondary  mr-2 btn-success">
                    <i class="icon-xl la la-file-excel"></i> <span>{{__('cp.export')}}</span>
                </a>
                <a href="{{url(getLocal().'/admin/users/create')}}" class="btn btn-secondary  mr-2 btn-success">
                    <i class="icon-xl la la-plus"></i>
                    <span>{{__('cp.add')}}</span>
                </a>

            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="gutter-b example example-compact">
                <div class="contentTabel">
                    <button type="button" class="btn btn-secondar btn--filter mr-2"><i
                            class="icon-xl la la-sliders-h"></i>{{__('cp.filter')}}</button>
                    <div class="container box-filter-collapse">
                        <div class="card">
                            <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/users')}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.id')}}</label>
                                            <input type="text" class="form-control" name="id" placeholder="{{__('cp.id')}}"
                                                value="{{request('id')?request('id'):''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.name')}}</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="{{__('cp.name')}}"
                                                value="{{request('name')?request('name'):''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.email')}}</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="{{__('cp.email')}}"
                                                value="{{request('email')?request('email'):''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.mobile')}}</label>
                                            <input
                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                type="text" class="form-control" name="mobile" placeholder="{{__('cp.mobile')}}"
                                                value="{{request('mobile')?request('mobile'):''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.status')}}</label>
                                            <select id="multiple2" class="form-control" name="status">
                                                <option value="">{{__('cp.all')}}</option>
                                                <option value="active" {{request('status')=='active' ?'selected':''}}>
                                                    {{__('cp.active')}}
                                                </option>
                                                <option value="not_active" {{request('status')=='not_active' ?'selected':''}}>
                                                    {{__('cp.not_active')}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit"
                                            class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                            <i class="fa fa-search"></i>
                                        </button>

                                        <a href="{{url(app()->getLocale().'/admin/users')}}" type="submit"
                                            class="btn sbold btn-default btnRest">{{__('cp.reset')}}
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div
                        class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                        <div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="checkAll" />
                                                <span></span></label>
                                        </div>
                                    </th>
                                    <th class="wd-25p"> {{ucwords(__('cp.id'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.email'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.mobile'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.date_of_birth'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.req_count'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                                    <th class="wd-15p"> {{ucwords(__('cp.action'))}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $one)
                                <tr class="odd gradeX" id="tr-{{$one->id}}">
                                    <td class="v-align-middle wd-5p">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                    name="chkBox" />
                                                <span></span></label>
                                        </div>
                                    </td>
                                    <td class="v-align-middle wd-25p">{{@$one->id}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->name}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->email}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->mobile}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->date_of_birth}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->order_count}}</td>
                                    <td class="v-align-middle wd-10p">
                                        <span id="label-{{$one->id}}" class="badge badge-pill badge-{{(@$one->status == "active") ? "info" : "danger" }}" id="label-{{$one->id}}">
                                            {{__('cp.'.@$one->status)}}
                                        </span>
                                    </td>

                                    <td class="v-align-middle wd-10p">{{@$one->created_at->format('Y-m-d')}}</td>

                                    <td class="v-align-middle wd-15p">
                                        <a href="{{url(getLocal().'/admin/users/'.@$one->id.'/show')}}"
                                            class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                            <i class="la la-eye"></i>
                                        </a>


                                        <div id="myModal{{$one->id}}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                        <h4 class="modal-title">{{__('cp.delete')}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{__('cp.confirm')}} </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn default" data-dismiss="modal"
                                                            aria-hidden="true">{{__('cp.cancel')}}</button>
                                                        <a href="#"
                                                            onclick="delete_adv('{{$one->id}}','{{$one->id}}',event)"><button
                                                                class="btn btn-danger">{{__('cp.delete')}}</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>
                        {{$items->appends($_GET)->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection
@section('js')

@endsection
