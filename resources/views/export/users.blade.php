<table>
    <thead>
    <tr>
        <th>الاسم</th>
        <th>رقم التليفون</th>
        <th>البريد الالكتروني </th>
        <th>تاريخ الانشاء</th>
    </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->name }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->created_at }} </td>
            </tr>

        @endforeach

    </tbody>
</table>
