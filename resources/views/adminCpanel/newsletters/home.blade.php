@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.newsletter_management'))}}
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{ucwords(__('cp.newsletters'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">

                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">
                            <i class="flaticon-delete"></i>
                            <span>{{__('cp.delete')}}</span>
                        </button>
                    </div>

                    <a href="{{route('admins.newsletters.create')}}" class="btn btn-secondary  mr-2 btn-success">
                        <i class="icon-xl la la-plus"></i>
                        <span>{{__('cp.add')}} </span>
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
                        <button  type="button" class="btn btn-secondar btn--filter mr-2"><i class="icon-xl la la-sliders-h"></i>{{__('cp.filter')}}</button>
                        <div class="container box-filter-collapse" >
                            <div class="card" >
                                <form class="form-horizontal" method="get" action="{{route('admins.newsletters.index')}}">
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{ __('cp.subject') }}</label>
                                            <input type="text" class="form-control" name="subject" placeholder="{{ __('cp.subject') }}"
                                                value="{{ request('subject') ? request('subject') : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{ __('cp.status') }}</label>
                                            <select id="multiple2" class="form-control" name="status">
                                                <option value="">{{ __('cp.all') }}</option>
                                                <option value="scheduled" {{ request('status')=='scheduled' ? 'selected' : '' }}>
                                                    {{ __('cp.scheduled') }}
                                                </option>
                                                <option value="delivered" {{ request('status')=='delivered' ? 'selected' : '' }}>
                                                    {{ __('cp.delivered') }}
                                                </option>
                                                <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>
                                                    {{ __('cp.draft') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn sbold btn-default btnSearch">
                                            {{ __('cp.search') }} <i class="fa fa-search"></i>
                                        </button>
                                        <a href="{{ url(app()->getLocale() . '/admin/newsletters') }}" class="btn sbold btn-default btnRest">
                                            {{ __('cp.reset') }} <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
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
                                                <input type="checkbox" name="checkAll" /> <span></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>{{ ucwords(__('cp.subject')) }}</th>
                                    <th>{{ ucwords(__('cp.status')) }}</th>
                                    <th>{{ ucwords(__('cp.date_time_for_send'))}}</th>
                                    <th>{{ ucwords(__('cp.total_recipients'))}}</th>
                                    <th>{{ ucwords(__('cp.created')) }}</th>
                                    <th>{{ ucwords(__('cp.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $one)
                                <tr class="odd gradeX" id="tr-{{ @$one->id }}">
                                    <td class="v-align-middle wd-5p">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" value="{{ @$one->id }}" class="checkboxes" name="chkBox" />
                                                <span></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="v-align-middle wd-25p">{{ $one->subject ?? '--' }}</td>
                                    <td class="v-align-middle wd-10p">
                                        <span
                                            class="badge badge-pill badge-{{ @$one->status === 'scheduled' ? 'primary' : ($one->status === 'delivered' ? 'success' : 'secondary') }}">
                                            {{ ucwords(__('cp.' . $one->status)) }}
                                        </span>
                                    </td>
                                    <td class="v-align-middle wd-25p">
                                        @if(@$one->status === 'scheduled' && @$one->date && @$one->time)
                                        {{ @$one->date }} - {{ @$one->time }}
                                        @else
                                        --
                                        @endif
                                    </td>
                                    <td class="v-align-middle wd-10p">{{ @$one->total_recipients }}</td>
                                    <td class="v-align-middle wd-10p">{{ @$one->created_at->format('Y-m-d') }}</td>
                                    <td class="v-align-middle wd-15p">
                                        @if (@$one->status == 'draft')
                                            <a href="{{ route('admins.newsletters.edit', @$one->id) }}" class="btn btn-sm btn-clean btn-icon"
                                                title="{{ __('cp.edit') }}">
                                                <i class="la la-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admins.newsletters.show', @$one->id) }}" class="btn btn-sm btn-clean btn-icon"
                                                title="{{ __('cp.show') }}">
                                                <i class="la la-eye"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <div
                                        style="text-align: center; color: #555; font-weight: bold; font-size: 18px; margin: 15px; padding: 20px; border: 2px dashed #ccc; border-radius: 10px; background-color: #f9f9f9;" id="no-data-message">
                                        @lang('cp.no_data')
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $items->appends($_GET)->links("pagination::bootstrap-4") }}
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
