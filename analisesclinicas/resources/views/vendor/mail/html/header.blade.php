@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Clínica UniFil')
<img src="https://i.postimg.cc/05my1LSd/Uni-Fil-Logo-Isolado-Horizontal-01.png" class="logo" alt="UniFil Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
