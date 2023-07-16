<div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.3);">
    <form wire:submit.prevent="executeButton(Object.fromEntries(new FormData($event.target)))">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('nalletje_livewiretables::lt.words.execute') }} "{{ $button_with_form->label() }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @includeWhen($message, 'nalletje_livewiretables::partials.messages.'.$message_type)

                    @foreach($button_with_form->fields() as $field)
                        {!! $field->build() !!}
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeActionModal">{{ trans('nalletje_livewiretables::lt.words.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('nalletje_livewiretables::lt.words.execute') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
