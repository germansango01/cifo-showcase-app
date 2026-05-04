<x-layouts.admin :title="__('admin.students.title')">

    <x-admin.ui.card>

        <x-admin.table.index :items="$students" :columns="[
            ['label' => 'Name'],
            ['label' => 'Email'],
            ['label' => 'Projects'],
            ['label' => ''],
        ]">

            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td><span class="badge">{{ $student->projects_count }}</span></td>

                    <td class="text-right">
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-xs">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach

        </x-admin.table.index>

    </x-admin.ui.card>

</x-layouts.admin>