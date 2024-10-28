<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/register.css" />
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">mogitate</h1>
        </header>
    </div>
    <div class="register">
        <h2 class="register__heading content__heading">商品登録</h2>
    </div>
    <form class='form form--register' action="/store" method="post" enctype="multipart/form-data">
        @csrf

        <div class="item-form__group item-form__name-group">
            <label class="item-form__label" for="name">
                商品名<span class="item-form__required">必須</span>
            </label>
            <div class="item-form__name-inputs">
                <input class="item-form__input item-form__name-input" type="text" name="name" id="name"
                    value="{{ old('name') }}" placeholder="商品名を入力">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="item-form__group">
            <label class="item-form__label" for="image">
                画像ファイル<span class="item-form__required">必須</span>
            </label>
            <input class="item-form__input" type="file" name="image" id="image" accept="image/*">
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="item-form__group item-form__name-group">
            <label class="item-form__label" for="price">
                値段<span class="item-form__required">必須</span>
            </label>
            <div class="item-form__name-inputs">
                <input class="item-form__input item-form__name-input" type="text" name="price" id="price"
                    value="{{ old('price') }}" placeholder="値段を入力">
            </div>
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="item-form__group">
            <label class="item-form__label">
                季節<span class="item-form__required">必須</span>
            </label>
            <div class="item-form__season-inputs">
                <div class="item-form__season-option">
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" name="season[]" type="checkbox" id="spring" value="1">
                        <span class="contact-form__season-text">春</span>
                    </label>
                </div>
                <div class="item-form__season-option">
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" name="season[]" type="checkbox" id="summer" value="2">
                        <span class="contact-form__season-text">夏</span>
                    </label>
                </div>
                <div class="item-form__season-option">
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" name="season[]" type="checkbox" id="autumn" value="3">
                        <span class="contact-form__season-text">秋</span>
                    </label>
                </div>
                <div class="item-form__season-option">
                    <label class="item-form__season-label">
                        <input class="item-form__season-input" name="season[]" type="checkbox" id="winter" value="4">
                        <span class="contact-form__season-text">冬</span>
                    </label>
                </div>
            </div>
            <div class="form__error">
                @error('season')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="item-form__group">
            <label class="item-form__label" for="description">
                商品説明<span class="item-form__required">必須</span>
            </label>
            <textarea class="item-form__textarea" name="description" id="description" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <input class="item-form__btn btn btn--primary" type="submit" value="登録">
        <input class="item-form__btn btn btn--secondary" type="submit" value="戻る" name="back">
    </form>
</body>

</html>