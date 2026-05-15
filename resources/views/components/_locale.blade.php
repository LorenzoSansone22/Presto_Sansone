<form action="{{ route('setLocale', $lang) }}" method="POST">
    @csrf
    <button type="submit" class="btn p-0 border-0">
        <img src="https://flagcdn.com/32x24/{{ $lang == 'uk' ? 'gb' : $lang }}.png" width="32" height="24" />
    </button>
</form>