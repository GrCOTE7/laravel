<form method="POST" action="{{ route('setlang') }}">
    @csrf
    <select name="lang" onchange="this.form.submit()">
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
        <!-- Ajoutez d'autres langues ici -->
    </select>
</form>
