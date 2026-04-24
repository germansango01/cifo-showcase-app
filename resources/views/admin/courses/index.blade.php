<h1>hola desde course</h1>

<ul>
    @foreach ($courses as $course)
        <li>{{ $course->name }} - {{ $course->course_code }} - Categoria: {{ $course->category->name_es }} </li>
    @endforeach
</ul>
