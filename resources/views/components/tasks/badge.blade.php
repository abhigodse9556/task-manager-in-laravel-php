@props([
'value',
'type',
])

@php
$statusClasses = [
'Pending' => 'bg-yellow-500 text-black',
'In Progress' => 'bg-blue-500 text-white',
'Completed' => 'bg-green-500 text-white',
];

$priorityClasses = [
'Low' => 'bg-green-500 text-white',
'Medium' => 'bg-yellow-500 text-black',
'High' => 'bg-red-500 text-white',
];
@endphp

@if ($type === 'status')
<span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$value] ?? 'bg-gray-500 text-white' }}">
    {{ $value }}
</span>
@elseif ($type === 'priority')
<span class="px-2 py-1 rounded-full text-xs font-semibold {{ $priorityClasses[$value] ?? 'bg-gray-500 text-white' }}">
    {{ $value }}
</span>
@elseif ($type === 'date_time')
<span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-500 text-white w-fit">
    {{ $value !== null ? $value->format('d-m-Y H:i:s') : 'N/A' }}
</span>
@endif