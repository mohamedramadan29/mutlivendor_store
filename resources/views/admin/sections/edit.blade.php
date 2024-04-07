<div class="modal" id="edit_model_{{$section['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل القسم </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/update_section')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="section_id" value="{{$section['id']}}">
                        <label> اسم القسم </label>
                        <input required type="text" name="section_name" class="form-control"
                               value="{{$section['name']}}">
                    </div>
                    <div class="form-group">
                        <label> حالة القسم </label>
                        <select required class="form-control" name="section_status">
                            <option> -- حدد حالة القسم --</option>
                            <option @if($section['status'] ==1) selected @endif value="1"> فعال</option>
                            <option @if($section['status'] ==0) selected @endif value="0">غير فعال</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit"> تعديل القسم
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
