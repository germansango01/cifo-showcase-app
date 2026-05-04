<x-layouts.admin :title="__('admin.teachers.title')">

    <x-admin.ui.card>

        <x-admin.table.index :items="$teachers" :columns="[
            ['label' => 'Name'],
            ['label' => 'Email'],
            ['label' => 'Courses'],
            ['label' => ''],
        ]">

            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td><span class="badge">{{ $teacher->courses_count }}</span></td>

                    <td class="text-right">
                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-xs">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach

        </x-admin.table.index>

    </x-admin.ui.card>

</x-layouts.admin>