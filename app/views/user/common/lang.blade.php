<div class="language_bar_chooser">
	<select name="lang">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <option value="{{ $localeCode }}" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" <?php if(!empty($lang) && $localeCode == $lang){echo 'selected="selected"';} ?> >
            {{{ $properties['native'] }}}
        </option>
    @endforeach
    </select>
</div>