<div class="modal" id="edit_model_{{$banner['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل البانر  </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/banners/update')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="banner_id" value="{{$banner['id']}}">
                    </div>
                    <div class="form-group">
                        <label>  العنوان الفرعي  </label>
                        <input required type="text" name="sub_title" class="form-control" value="{{$banner['sub_title']}}">
                    </div>
                    <div class="form-group">
                        <label>  العنوان الاساسي   </label>
                        <input required type="text" name="title" class="form-control" value="{{$banner['title']}}">
                    </div>
                    <div class="form-group">
                        <label>  رابط الزر  </label>
                        <input required type="text" name="link" class="form-control" value="{{$banner['link']}}">
                    </div>

                    <div class="form-group">
                        <label> الصوره  </label>
                        <input type="file" name="image" class="form-control">
                        <img width="80px" height="80px" src="{{\Illuminate\Support\Facades\Storage::url($banner->image)}}" alt="">
                    </div>
                    <div class="form-group">
                        <label> الحاله  </label>
                        <select required class="form-control" name="status">
                            <option> -- حدد حالة  --</option>
                            <option @if($banner['status'] ==1) selected @endif value="1"> فعال</option>
                            <option @if($banner['status'] ==0) selected @endif value="0">غير فعال</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">  تعديل
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
