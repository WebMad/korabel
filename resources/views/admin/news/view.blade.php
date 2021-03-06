@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <h2>Новости</h2>
    <span><a href="{{ route('admin.news.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Заголовок"
               id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
    <table>
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="70%">Заголовок</th>
            <th width="25%">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $new)
            <tr>
                <td>{{ $new['id'] }}</td>
                <td>{{ $new['header'] }}</td>
                <td>
                    <div class="actions">
                        <a class="action-button" href="{{ route('admin.news.edit', ['news'=> $new['id']]) }}">
                            <button>Редактировать</button>
                        </a>
                        <form class="action-button" action="{{ route('admin.news.destroy', ['news'=> $new['id']]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button>Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $news->links() }}
@endsection