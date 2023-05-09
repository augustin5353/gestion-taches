<x-mail::message>
# Rappel sur une tache à écheance proche

La tache du num:  <a href="{{ route('taches.edit', ['tach' => $tache])}}">{{ $tache->name }} </a> est proche de son échéance

-Date debut: {{ $tache->beginned_at }} <br>  <br>
-Date échéance: {{ $tache->finish_at }} <br>  <br>
-Niveau: {{ Str::upper($tache->level) }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
