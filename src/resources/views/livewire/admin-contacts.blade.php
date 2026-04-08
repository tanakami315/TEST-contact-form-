<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    @if (session()->has('message'))
        <div class="flash-message">
            {{ session('message') }}
        </div>
    @endif

    <div class="search">
        <form class="search-form" wire:submit.prevent="search">
            <input
                class="search-form__keyword"
                type="text"
                wire:model.defer="keyword"
                placeholder="名前やメールアドレスを入力してください"
            />

            <select class="search-form__gender" wire:model.defer="gender">
                <option value="placeholder" disabled>性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>

            <select class="search-form__category" wire:model.defer="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input
                class="search-form__date"
                type="date"
                wire:model.defer="created_at"
            />

            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>

            <div class="reset">
                <button type="button" wire:click="resetSearch">リセット</button>
            </div>
        </form>
    </div>

    <div class="function">
        <form class="export" action="/export" method="get">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <button type="submit">エクスポート</button>
        </form>

        <div class="pagination">
            {{ $contacts->links('vendor.pagination.tailwind2') }}
        </div>
    </div>

    <table class="result">
        <tr class="result__label">
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>

        @foreach ($contacts as $contact)
            <tr class="result__content">
                <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                <td>
                    {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <button
                        type="button"
                        class="detail-button"
                        wire:click="showDetail({{ $contact->id }})"
                    >
                        詳細
                    </button>
                </td>
            </tr>
        @endforeach
    </table>

    @if($showModal && $selectedContact)
        <div class="modal">
            <div class="modal__view">
                <button type="button" class="modal__close" wire:click="closeModal">×</button>

                <div class="modal__row">
                    <div class="modal__label">お名前</div>
                    <div class="modal__content">
                        {{ $selectedContact->last_name }}　{{ $selectedContact->first_name }}
                    </div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">性別</div>
                    <div class="modal__content">
                        {{ $selectedContact->gender == 1 ? '男性' : ($selectedContact->gender == 2 ? '女性' : 'その他') }}
                    </div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">メールアドレス</div>
                    <div class="modal__content">{{ $selectedContact->email }}</div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">電話番号</div>
                    <div class="modal__content">{{ $selectedContact->tel }}</div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">住所</div>
                    <div class="modal__content">{{ $selectedContact->address }}</div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">建物名</div>
                    <div class="modal__content">{{ $selectedContact->building }}</div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">お問い合わせの種類</div>
                    <div class="modal__content">{{ $selectedContact->category->content }}</div>
                </div>

                <div class="modal__row">
                    <div class="modal__label">お問い合わせ内容</div>
                    <div class="modal__content">{{ $selectedContact->detail }}</div>
                </div>

                <div class="modal__delete-form">
                    <button
                        type="button"
                        class="modal__delete-button"
                        wire:click="deleteContact({{ $selectedContact->id }})"
                    >
                        削除
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>