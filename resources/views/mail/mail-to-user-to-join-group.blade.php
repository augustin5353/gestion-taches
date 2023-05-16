<x-mail::message>
# Invitation pour rejoindre groupe de travail

Vous avez récu une invitation de rejoindre une groupe de travail <b><b>

Information du groupe : 

Nom: {{$group->name}} <b>

Description: {{$group->description}} <b>

Nom Autheur: {{$group->user->name}} <b>

Email Autheur: {{$group->user->email}} <b>

<a href="{{ route('action.response.notification.user.to.join.group', ['group' => $group, 'user' => $user->id])}}">Accepter l'invitation</a>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
