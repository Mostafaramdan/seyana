<table>
    <thead>
        <tr >
            <th >الاسم بالعربي </th>
            <th >الاسم بالانجليزي </th>
            <th >الدولة </th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->name_ar }}</td>
                <td>{{ $record->name_en }}</td>
                <td>{{ $record->country->name_ar }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
