@if ($with_buttons && count($buttons))
    @foreach($buttons as $key => $button)
        @includeWhen($button->hasForm(), 'nalletje_livewiretables::partials.buttons.button-with-form', compact('key','button'))
        @includeWhen(!$button->hasForm(), 'nalletje_livewiretables::partials.buttons.button', compact('button'))
    @endforeach
@endif
