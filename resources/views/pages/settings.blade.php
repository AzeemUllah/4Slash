
@include('includes.header')

{{--settings start--}}
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-portlet m-portlet--tab" style="margin-right: 30px; margin-left: 30px;margin-top: 60px;">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        My Settings
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin::Section-->
            <div class="m-section m-section--last">
                <!--<span class="m-section__sub">-->
                <!--Solid style:-->
                <!--</span>-->
                <div class="m-section__content">
                    <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                        <div class="m-demo__preview">
                            <!--begin::Form-->
                            <form class="m-form">
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Order Messages
                                    </label>
                                    <div class="col-3">
																	<span class="m-switch m-switch--success">
																		<label>
																			<input type="checkbox" {{ ($user->email_notify) == 1 ? 'checked' :'' }} checked="checked" name="">
																			<span></span>
																		</label>
																	</span>
                                    </div>

                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Order status
                                    </label>
                                    <div class="col-3">
																	<span class="m-switch m-switch--info">
																		<label>
																			<input type="checkbox" {{ ($user->order_notify) == 1 ? 'checked' :'' }} checked="checked" name="">
																			<span></span>
																		</label>
																	</span>
                                    </div>

                                    <form action="{{ route('notify.settings') }}" method="post">
                                        <input type="hidden" name="email_notify" value="{{ $user->email_notify }}" id="email_notify">
                                        <input type="hidden" name="order_notify" value="{{ $user->order_notify }}" id="order_notify">

                                    </form>
                                </div>
                                <button type="button" class="btn btn-primary">
                                    Save
                                </button>


                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
    <!-- END: Subheader -->

</div>
{{--setting end--}}


@include('includes.footer')