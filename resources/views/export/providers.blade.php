<table>
    <thead>
    <tr>
        <th>الاسم</th>
        <th>رقم التليفون</th>
        <th>البريد الالكتروني </th>
        <th>المنطقة</th>
        <th>الموافقة</th>
    </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->name }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->region->name_ar }}</td>
                <td>{{$record->is_approved?'yes':'no'}}</td>
            </tr>

        @endforeach

    </tbody>
</table>
