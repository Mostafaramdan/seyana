<table>
    <thead>
        <tr >
            <th >الاسم  </th>
            <th >الدولة  </th>
            <th >السعر  </th>
            <th >فترة الضمان  </th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->name_ar }}</td>
                <td>{{ $record->category->country->name_ar??'' }}</td>
                <td>{{ $record->price }}</td>
                <td>{{ $record->warranty_period }} </td>
            </tr>

        @endforeach

    </tbody>
</table>
