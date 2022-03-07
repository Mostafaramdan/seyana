<table>
    <thead>
    <tr>
        <th>كود</th>
        <th>الوصف</th>
        <th>مواد اخري</th>
        <th>عدد الخدمات</th>
        <th>السعر</th>
        <th>الرسوم</th>
    </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->description }}</td>
                <td>{{ $record->materials }}</td>
                <td>{{ $record->carts->count() }}</td>
                <td>{{ $record->carts->sum('price') }}</td>
                <td>{{ $record->fees }} % </td>
            </tr>

            <tr>
                <th>اسم الخدمة </th>
                <th>السعر</th>
            </tr>

            @foreach($record->carts as $cart)
                <tr>
                    <td>{{ $cart->service->name_ar }}</td>
                    <td>{{ $cart->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>

        @endforeach

    </tbody>
</table>
