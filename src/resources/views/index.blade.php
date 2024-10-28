<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$products</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">mogitate</h1>
        </header>
    </div>
    <div class="admin">
        <h2 class="admin__heading content__heading">商品一覧</h2>
        <div class="admin__inner">

            <!--検索フォーム-->
            <form class="search-form" action="{{ route('products.search') }}" method="get">
                @csrf
                <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名を入れてください">
                <div class="search-form__actions">
                    <input class="search-form__search-btn btn" type="submit" value="検索">
                </div>
            </form>
            <!--商品登録フォーム-->
            <form class="register-form" action="/register" method="post">
                @csrf
                <div class="search-form__actions">
                    <input class="search-form__register-btn btn" type="submit" value="＋商品を追加">
                </div>
            </form>
            <!--並べ替え-->
            <div class="sort-form">
                <form action="{{ route('products.index') }}" method="get">
                    <label for="sort">並べ替え:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="">選択してください</option>
                        <option value="price_asc">価格 (低い順)</option>
                        <option value="price_desc">価格 (高い順)</option>
                    </select>
                </form>
            </div>
            <div class="sort-tag">
                @if(request('sort'))
                <span class="tag">
                    並べ替え:
                    @if(request('sort') == 'name_asc')
                    商品名 (A-Z)
                    @elseif(request('sort') == 'name_desc')
                    商品名 (Z-A)
                    @elseif(request('sort') == 'price_asc')
                    価格 (低い順)
                    @elseif(request('sort') == 'price_desc')
                    価格 (高い順)
                    @endif
                    <a href="{{ route('products.index') }}" class="remove-tag">×</a>
                </span>
                @endif
            </div>

            <!-- 商品一覧-->
            <table class="admin__table">
                <tr class="admin__row admin__row--header">
                    <th class="admin__label">画像</th>
                    <th class="admin__label">商品名</th>
                    <th class="admin__label">価格</th>
                    <th class="admin__label"></th>
                </tr>
                @if($products->isEmpty())
                <p>該当する商品が見つかりませんでした。</p>
                @else
                @foreach($products as $product)
                <tr class="admin__row">
                    <td class="admin__data">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100" height="100">
                        </a>
                    </td>
                    <td class="admin__data">{{ $product->name }}</td>
                    <td class="admin__data">{{ $product->price }}</td>
                    <td class="admin__data">
                        <a class="admin__detail-btn" href="{{ route('products.show', $product->id) }}">詳細</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>

            {{ $products->links() }}

        </div>
    </div>



</body>

</html>