<!-- Modal -->
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('sections_trans.edit_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sections.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{__('sections_trans.name_sections')}}</label>
                    <input type="hidden" name="id" value="{{ $section->id }}">
                    <input type="text" name="name" value="{{ $section->name }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword2">{{__('sections_trans.description')}}</label>
                    <input type="hidden" name="id" value="{{ $section->id }}">
                    <input type="text" name="description" value="{{ $section->description }}" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
