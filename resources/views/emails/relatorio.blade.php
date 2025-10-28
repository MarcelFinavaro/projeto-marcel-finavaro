<x-mail::message>
# Relatório de Ordens de Serviço

Olá!  
Segue em anexo o relatório completo das ordens de serviço cadastradas no sistema.

<x-mail::button :url="route('ordens.index')">
Ver Ordens de Serviço
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>