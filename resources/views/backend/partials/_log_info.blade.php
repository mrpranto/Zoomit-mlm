<span tabindex="0" data-toggle="popover" data-trigger="focus"
      data-html="true"
      data-original-title="<i class='ace-icon fa fa-info-circle green'></i> {{ __t('log_info') }}"
      data-content="<p>Created By: {{ $data->createdBy->name }}.</p> <p> Created At : {{ $data->created_at->format(date_time_format()) }} </p>
                                        <hr/>
                                        <p>Updated By: {{ $data->updatedBy->name }}.</p> <p> Updated At : {{ $data->updated_at->format(date_time_format()) }} </p>"
      class="action-icon">
                                    <i class="mdi mdi-information-outline"></i>
                                </span>
