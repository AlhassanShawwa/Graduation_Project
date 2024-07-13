<!-- Modal -->
<div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('sections_trans.delete_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sections.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $section->id }}">
                <h5>{{__('sections_trans.Warning')}}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('sections_trans.Close')}}</button>
                <button type="submit" class="btn btn-danger">{{__('sections_trans.submit')}}</button>
            </div> 
            </form>
        </div>
    </div>
</div>
