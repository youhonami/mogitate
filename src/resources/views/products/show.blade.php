<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} の詳細</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">mogitate</h1>
        </header>

        <h1 class="product__title">{{ $product->name }}の詳細</h1>
        <p class="product__price">価格: {{ $product->price }}</p>
        <!-- 季節情報の表示 -->
        <div class="product__seasons">
            <p>旬の季節:</p>
            <ul>
                @foreach ($product->seasons as $season)
                <li>{{ $season->name }}</li>
                @endforeach
            </ul>
        </div>
        <p class="product__description">説明: {{ $product->description }}</p>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product__image">

        <a href="/products" class="btn btn--back">商品一覧に戻る</a>

        <!-- 削除ボタン -->
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')" class="delete-form__button">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>

        <!-- 更新用のフォーム -->
        <h2 class="form__title">商品情報の変更はこちら</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="update-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-group__label">商品名:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力" class="form-group__input">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="form-group__label">価格:</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力" class="form-group__input">
            </div>
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
            <div class="item-form__group">
                <label class="item-form__label">季節:</label>
                <div class="item-form__season-inputs">
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" name="season[]" type="checkbox" id="spring" value="1">
                        <span class="contact-form__season-text">春</span>
                    </label>
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" type="checkbox" name="season[]" id="summer" value="2">
                        <span class="contact-form__season-text">夏</span>
                    </label>
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" type="checkbox" name="season[]" id="autumn" value="3">
                        <span class="contact-form__season-text">秋</span>
                    </label>
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" type="checkbox" name="season[]" id="winter" value="4">
                        <span class="contact-form__season-text">冬</span>
                    </label>
                </div>
                <div class="form__error">
                    @error('season')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-group__label">商品説明:</label>
                <textarea name="description" id="description" class="form-group__textarea no-resize" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="form-group__label">画像:</label>
                <input type="file" name="image" id="image" class="form-group__input">
            </div>
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <button type="submit" class="btn btn--submit">変更を保存</button>
        </form>
    </div>
</body>

</html>